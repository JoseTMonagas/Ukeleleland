<template>
    <div class="row">
        <div class="col">
            <h5 class="text-primary border-bottom">Tu compra en Ukeleleland</h5>
            <div v-if="active == 0">
                <h5 class="text-primary border-bottom">Datos Personales</h5>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Nombre:</label>
                        <input type="text" class="form-control" v-model.trim="nombre" />
                        <small class="text-muted">Obligatorio</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="apellido">Apellido:</label>
                        <input type="text" class="form-control" v-model.trim="apellido" />
                        <small class="text-muted">Obligatorio</small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="rut">RUT:</label>
                        <input type="text" class="form-control" v-model.trim="rut" />
                        <small class="text-muted">Obligatorio</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="telefono">Teléfono:</label>
                        <input type="text" class="form-control" v-model.trim="telefono" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="email" class="form-control" v-model.trim="email" />
                        <small class="text-muted">Obligatorio</small>
                </div>
                <button type="button" @click="active = 1" class="btn btn-primary">Siguiente</button>
            </div>
            <div v-if="active == 1">
                <h5 class="text-primary border-bottom">Direccion de Entrega</h5>
                <div class="form-group">
                    <label for="comuna">Comuna:</label>
                    <v-select :options="options" v-model="commune" @input="getDispatchPrice"></v-select>
                        <small class="text-muted">Obligatorio</small>
                </div>
                <div class="form-group">
                    <label for="direccion">Dirección:</label>
                    <textarea
                        cols="30"
                        class="form-control"
                        v-model.trim="direccion"
                        rows="10">
                    </textarea>
                        <small class="text-muted">Obligatorio</small>
                </div>
                <button type="button" @click="active = 0" class="btn btn-secondary">Regresar</button>
                <button type="button" @click="active = 2" class="btn btn-primary">Siguiente</button>
            </div>
            <div v-if="active == 2">
                <h5 class="text-primary border-bottom">Confirma tus datos</h5>

                <div class="table-responsive">
                    <table class="table table-sm">
                        <tr>
                            <th>Nombre:</th>
                            <td>{{ nombre }}</td>
                            <th>Apellido:</th>
                            <td>{{ apellido }}</td>
                        </tr>
                        <tr>
                            <th>Telefono:</th>
                            <td>{{ telefono }}</td>
                            <th>RUT:</th>
                            <td>{{ rut }}</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>{{ email }}</td>
                            <th>Comuna:</th>
                            <td>{{ commune.label }}</td>
                        </tr>
                    </table>
                    <label><b>Direccion:</b></label>
                    <textarea class="form-control-plaintext" cols="30" disabled :value="direccion" rows="10"></textarea>
                </div>

                <div class="row">
                    <button @click="active = 0" class="btn btn-info mx-1">Cambiar Datos Personales</button>
                    <button @click="active = 1" class="btn btn-warning mx-1">Cambiar Direccion</button>
                    <button @click="active = 3" class="btn btn-success mx-1" :disabled="dispatchPrice == null">Comprar</button>
                </div>
            </div>
            <div v-if="active == 3">
                <h5 class="text-primary border-bottom">Escoje tu metodo de pago</h5>
                <form :action="action" method="POST" accept-charset="utf-8">
                    <input type="hidden" :value="csrf" name="_token"/>

                    <button class="btn btn-success">WebPay</button>
                </form>
                <button class="btn btn-success" @click="transferenciaDlg">Transferencia</button>
            </div>
        </div>

        <div class="col">
            <h5 class="text-primary border-bottom my-3 my-lg-0">Detalle de Compra</h5>
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th scope="col">Producto</th>
                        <th scope="col">Precio Unitario</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in products" :key="item.rowId">
                        <td>{{ item.name }}</td>
                        <td>{{ formatCurrency(item.price) }}</td>
                        <td>
                            <select v-model="item.qty" @change="calcularSubtotal(index)">
                                <option v-for="i in (8)" :key="i">{{ i }}</option>
                            </select>
                        </td>
                        <td>{{ formatCurrency(item.subtotal) }}</td>
                    </tr>
                </tbody>
            </table>
            <b>Despacho</b>: {{ dispatchPrice ? formatCurrency(dispatchPrice) : 'Ingrese su comuna' }}<br>
            <b>Total</b>: {{ formatCurrency(total) }}<br>
            <div class="jumbotron">
                <p>¿Tienes un cupon?</p>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="" aria-label="Ingresa tu cupon" aria-describedby="button-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2">Canjear</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import vSelect from 'vue-select';

export default {
    components: {
'v-select': vSelect
    },
    created() {
        this.products = Object.values(this.cart).map(function(item) {
            return {
                rowId: item.rowId,
                id: item.id,
                name: item.name,
                qty: item.qty,
                price: item.price,
                subtotal: item.qty * item.price
            }
        });
        this.calcularTotal();
        if (!(this.profile === null)) {
            this.active = 2;
            this.nombre = this.profile.name;
            this.surname = this.profile.surname;
            this.rut = '30686957-4';
            this.telefono = this.profile.phone;
            this.email = 'test@email.com';
            this.direccion = this.profile.address;
            this.commune = this.profile.commune_id;
        }
      this.getDispatchPrice();
    },
    props: {
        regions: Array,
        communes: Array,
        cart: Object,
        csrf: String,
        action: String,
        updateAction: String,
        transactionAction: String,
        home: String,
        profile: {
            type: Object,
            default: null
        }
    },
    data: function() {
        return {
            dispatchPrice: null,
            products: [],
            active: 0,
            total: null,
            nombre: '',
            apellido: '',
            rut: '',
            telefono: '',
            email: '',
            direccion: '',
            commune: null
        };
    },
    computed: {
        options: function() {
            return this.communes.map( item => {
                return {label: item.name, value: item.id};
            });
        }
    },
    methods: {
        formatCurrency: function(value) {
            return '$' + Math.round(parseFloat(value)).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
        },
        calcularSubtotal(index) {
            this.products[index].subtotal = this.products[index].qty * this.products[index].price;
            this.calcularTotal();
            this.actualizarCantidad(index);
        },
        calcularTotal() {
            let calculo = 0;
            for (var i = 0, len = this.products.length; i < len; i++) {
                calculo += this.products[i].subtotal;
            }
            this.total = calculo;
        },
        getDispatchPrice() {
            let id = this.commune.value;
            axios
                .get("/public/dispatch-price/" + id)
                .then(response => (response.data.price > 0 ? this.dispatchPrice = response.data.price : Swal.fire('¡Lo sentimos!', 'No hay despachos disponibles para esa comuna :C', 'error')));
        },
        actualizarCantidad(index) {
            let rowId = this.products[index].rowId;
            let qty = this.products[index].qty;
            let updateAction = this.updateAction;
            axios.post(updateAction, {
                rowId: rowId,
                qty: qty
            }).then(function(response) {
                console.log(response)
            }).catch(function(error) {
                console.error(error)
            });
        },
        transferenciaDlg() {
            let action = this.transactionAction;
            let data = {
                name: this.nombre,
                surname: this.apellido,
                phone: this.telefono,
                email: this.email,
                rut: this.rut,
                commune: this.commune.label,
                address: this.direccion
            };
            let home = this.home;
            Swal.fire({
                title: '<strong>Transferencia</strong>',
                html: 
                'Realiza una transferencia a la siguiente cuenta, y envia el ' +
                'comprobante al siguiente correo: <a href="mailto:pagos@ukelelelandbrand.cl">pagos@ukelelelandbrand.cl</a>' +
                '<table class="table table-sm">' +
                '<tr>' +
                '<th>Nombre:</th><td>ONDA MUSICAL SPA</td>' +
                '</tr>' +
                '<tr>' +
                '<th>RUT:</th><td>77.035.402-1</td>' +
                '</tr>' +
                '<tr>' +
                '<th>Cuenta:</th><td>29170755489</td>' +
                '</tr>' +
                '<tr>' +
                '<th>Tipo de Cuenta:</th><td>Vista</td>' +
                '</tr>' +
                '<tr>' +
                '<th>Banco:</th><td>Banco Estado</td>' +
                '</tr>' +
                '</table>',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Listo',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.value) {
                    axios
                        .post(action, {...data})
                        .then(response => {
                            if (response.data.status === 'OK') {
                                Swal.fire(
                                    '¡Todo Listo!',
                                    'Tu compra esta siendo procesada',
                                    'success'
                                ).then(() => {
                                    window.location.assign(home);
                                });
                            } else {
                                Swal.fire(
                                    '¡Ha ocurrido un error!',
                                    'Hubo un problema procesando tu pedido, intenta de nuevo mas tarde o ponte en contacto con nosotros',
                                    'error'
                                ).then(() => {
                                    window.location.assign(home);
                                });
                            }
                        });
                }
            })
        }
    }
};
</script>
<style></style>

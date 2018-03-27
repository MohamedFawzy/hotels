<template>
    <div>
        <div class="form-group">
            <router-link to="/" class="btn btn-default">Back</router-link>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Edit Hotel</div>
            <div class="panel-body">
                <form v-on:submit="saveForm()">
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Hotel name</label>
                            <input type="text" v-model="hotel.name" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Hotel price</label>
                            <input type="text" v-model="hotel.price" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Hotel availability from</label>
                            <input type="text" placeholder="month-day-year" v-model="hotel.availability[0].from" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Hotel availability to</label>
                            <input type="text" placeholder="month-day-year" v-model="hotel.availability[0].to" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <button class="btn btn-success">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            let app = this;
            let id = app.$route.params.id;
            app.hotelId = id;
            axios.get('/api/v1/hotels/' + id)
                .then(function (resp) {
                    app.hotel = resp.data.data;
                })
                .catch(function () {
                    alert("Could not load your hotel")
                });
        },
        data: function () {
            return {
                hotelId: null,
                hotel: {
                    name: '',
                    price: '',
                    city: '',
                    availability: [{
                        'from' : '',
                        'to'   : '',
                    }] ,
                },
            }
        },

        methods: {
            saveForm() {
                var app = this;
                var newHotel = app.hotel;
                axios.patch('/api/v1/hotels/' + app.hotelId, newHotel)
                    .then(function (resp) {
                        app.$router.replace('/');
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Could not create your hotel");
                    });
            }
        }
    }
</script>
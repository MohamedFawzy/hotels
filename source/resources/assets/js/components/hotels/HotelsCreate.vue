
<template>
    <div>
        <div class="form-group">
            <router-link to="/" class="btn btn-default">Back</router-link>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Create new hotel</div>
            <div class="panel-body">
                <form v-on:submit="saveForm()">
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">hotel name</label>
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
                            <label class="control-label">Hotel city</label>
                            <input type="text" v-model="hotel.city" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Hotel availability from</label>
                            <input type="datetime-local" v-model="hotel.availability.from" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <button class="btn btn-success">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                hotel: {
                    name: '',
                    price: '',
                    city: '',
                    availability: {
                        'from' : '',
                        'to'   : '',
                    },
                }
            }
        },
        methods: {
            saveForm() {
                event.preventDefault();
                var app = this;
                var newHotel = app.hotel;
                axios.post('/api/v1/hotels', newHotel)
                    .then(function (resp) {
                        app.$router.push({path: '/'});
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Could not create your hotel");
                    });
            }
        }
    }
</script>
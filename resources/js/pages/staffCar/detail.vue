<template >
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Staff of Car Detail</div>

                <div class="card-body">
                 <div class="flex flex-row  gap-3">
                    <h3 >Car Info</h3>
                    <hr class="py-2 my-0">
                    <p><strong>Car Plate: </strong><span>{{ car.hasOwnProperty('car_plate')? car.car_plate : '' }}</span></p>
                    <p><strong>Car Name: </strong><span>{{ car.hasOwnProperty('car_name')? car.car_name : '' }}</span></p>
                    <p><strong>Car Model: </strong><span>{{ car.hasOwnProperty('car_model')? car.car_model : '' }}</span></p>
                    <p><strong>Car Info: </strong><span>{{ car.hasOwnProperty('car_name')? car.car_info : '' }}</span></p>
                 </div>
                 <div class="flex flex-row  gap-3">
                    <h3 >Staff Info</h3>
                    <hr class="py-2 my-0">
                    <p><strong>Staff Name: </strong><span>{{ staff.hasOwnProperty('name')? staff.name : '' }}</span></p>
                    <p><strong>Staff Email: </strong><span>{{ staff.hasOwnProperty('email')? staff.email : '' }}</span></p>
                 </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
export default {
    data() {
        return {
            car: {},
            staff:{}
           
        };
    },

    created(){
        this.getData();
    },
    methods: {
        getData() {
            axios.get(this.route("api.staffCar.show",{id : this.route().params.id})).then((res) => {
                this.car = res.data.data.car;
                this.staff = res.data.data.staff;
            });
        },
       
    },
};
</script>
<style >
    
</style>
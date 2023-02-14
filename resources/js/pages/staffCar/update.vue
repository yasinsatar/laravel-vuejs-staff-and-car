<template >
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Personel Araç Güncelle</div>

                <div class="card-body">
                    <form @submit.prevent="submitUpdate">
                            <div class="mb-3">
                                <label
                                    for="exampleInputEmail1"
                                    class="form-label"
                                    >Cars</label
                                >
                                <select
                                    v-model="form.car_id"
                                    class="form-select"
                                    aria-label="Default select example"
                                >
                                <option value="" selected>
                                        Please, select a car
                                    </option>
                                    <option selected disabled :value="old_car.id" >
                                        {{ old_car.car_plate }}
                                    </option>
                                </select>
                                <div
                                    v-if="v$.form.car_id.$errors.length>0"
                                    class="input-errors text-danger"
                                    v-for="error in v$.form.car_id.$errors"
                                    :key="error.$uid"
                                >
                                    <div class="error-msg">
                                        {{ error.$message }}
                                    </div>
                                </div>
                                <div
                                    v-else="errors.car_id.length>0"
                                    class="input-errors text-danger"
                                    v-for="error in errors.car_id"
                                >
                                    <div class="error-msg">
                                        {{ error }}
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label
                                    for="exampleInputPassword1"
                                    class="form-label"
                                    >Staffs</label
                                >
                                <select
                                    v-model="form.staff_id"
                                    class="form-select"
                                    aria-label="Default select example"
                                >
                                    <option value="" selected>
                                        Please, select a staff
                                    </option>
                                    <option
                                        :value="staff.id"
                                        v-for="staff in staffs"
                                    >
                                        {{ staff.name }}
                                    </option>
                                </select>
                                <div
                                    v-if="v$.form.staff_id.$errors.length>0"
                                    class="input-errors text-danger"
                                    v-for="error in v$.form.staff_id.$errors"
                                    :key="error.$uid"
                                >
                                    <div class="error-msg">
                                        {{ error.$message }}
                                    </div>
                                </div>
                                <div
                                    v-else="errors.staff_id.length>0"
                                    class="input-errors text-danger"
                                    v-for="error in errors.staff_id"
                                >
                                    <div class="error-msg">
                                        {{ error }}
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                Add
                            </button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
import { useVuelidate } from "@vuelidate/core";
import { required, integer } from "@vuelidate/validators";
export default {
    setup() {
        return { v$: useVuelidate() };
    },
    data() {
        return {
            old_car: {id:null, car_plate:null},
            old_staff: null,
            cars: [],
            staffs: [],
            form: {
                staff_id: null,
                car_id: null,
            },
            errors: {
                staff_id: [],
                car_id: [],
            },
        };
    },
    validations() {
        return {
            form: {
                staff_id: { required },
                car_id: { required },
            },
        };
    },
    created(){
        this.getData();
    },
    methods: {
        getData() {
            axios.get(this.route("api.staffCar.edit",{id : this.route().params.id})).then((res) => {
                this.old_car = res.data.data.car;
                this.form.car_id = res.data.data.car.id;
                this.old_staff = res.data.data.staff.id;
                this.form.staff_id = res.data.data.staff.id;
                this.staffs = res.data.data.staffs;
            });
        },
        async submitUpdate() {
            const isFormCorrect = await this.v$.$validate();
            // you can show some extra alert to the user or just leave the each field to show it's `$errors`.
            if (!isFormCorrect) return;

            axios
                .put(this.route("api.staffCar.update",{id : this.route().params.id,staff_id:this.form.staff_id}), this.form)
                .then((res) => {
                    if (res.data.status) {
                        alert(res.data.message);
                        window.location.href = this.route(
                            "pages.staffCar.index"
                        );
                    } else {
                        alert(res.data.message);
                    }
                })
                .catch((e) => {
                    if (e.response.data) {
                        if (e.response.data.errors) {
                            this.errors = e.response.data.errors;
                            console.log(this.errors);
                        }
                    }
                });
        },
    },
};
</script>
<style >
    
</style>
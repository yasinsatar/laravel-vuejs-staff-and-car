<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Personel Araç Ekle</div>
                    <div class="card-body">
                        <form @submit.prevent="submitCreate">
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
                                    <option :value="car.id" v-for="car in cars">
                                        {{ car.car_plate }}
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
            staffs: [],
            cars: [],
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
    created() {
        this.getStaff();
        this.getCars();
    },
    methods: {
        getStaff() {
            axios.get(this.route("api.staff.all")).then((res) => {
                this.staffs = res.data.data;
            });
        },
        getCars() {
            axios.get(this.route("api.car.all")).then((res) => {
                this.cars = res.data.data;
            });
        },
        async submitCreate() {
            const isFormCorrect = await this.v$.$validate();
            // you can show some extra alert to the user or just leave the each field to show it's `$errors`.
            if (!isFormCorrect) return;

            axios
                .post(this.route("api.staffCar.create"), this.form)
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
<style></style>

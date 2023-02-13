<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Personel Araç Listesi</div>

                    <div class="card-body">
                        <div>
                            <table class="table table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Staff Name</th>
                                        <th>Car Info</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="row in laravelData.data"
                                        :key="row.id"
                                    >
                                        <td>{{ row.staff.name }}</td>
                                        <td>{{ row.car.car_plate }}</td>
                                        <td>
                                            <div class="d-flex flex-col gap-2">
                                                <a
                                                    :href="
                                                        route(
                                                            'pages.staffCar.detail',
                                                            { id: row.id }
                                                        )
                                                    "
                                                >
                                                    <button
                                                        class="btn btn-sm btn-success"
                                                    >
                                                        Göster
                                                    </button>
                                                </a>
                                                <a href="">
                                                    <button
                                                        class="btn btn-sm btn-primary"
                                                    >
                                                        Düzenle
                                                    </button>
                                                </a>
                                                <a href="">
                                                    <button
                                                        class="btn btn-sm btn-danger"
                                                    >
                                                        Sil
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <Bootstrap5Pagination
                                :data="laravelData"
                                @pagination-change-page="getResults"
                            />
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
            laravelData: {},
        };
    },
    created() {      
        let page = this.getParam("page")? this.getParam("page").value : 1;
        this.getResults(page);
    },
    methods: {
        getResults(page = 1) {
            axios
                .get(`${this.route("api.getStaffCar")}/?page=${page}`)
                .then((res) => {
                    this.laravelData = res.data;
                    this.changeParam("page", page);
                });
        },
        changeParam(param, newValue) {
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            urlParams.set(param, newValue);
            
            var newUrl =
                window.location.origin +
                window.location.pathname +
                "?" +
                urlParams.toString();
            window.history.pushState({ path: newUrl }, "", newUrl);
        },
        getParam(param){
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            return urlParams.has(param)? {value:urlParams.get(param)} : false;
        }
    },
};
</script>
<style></style>

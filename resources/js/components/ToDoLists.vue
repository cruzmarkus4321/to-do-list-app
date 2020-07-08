<template>
    <div>
        <h2>To Do List</h2>

        <h1>{{ toDoLists }}</h1>

        <div class="card card-body" v-for="toDoList in toDoLists" v-bind:key="toDoList.id">
            <h3>{{ toDoList.title }}</h3>
            <p>{{ toDoList.description }}</p>
            <p>{{ toDoList.date_time }}</p>
            <p>{{ toDoList.username }}</p>
        </div>

    </div>
</template>

<script>
export default {
    data() {
        return {
            hello: [],
            toDoLists: [],
            edit: false,
        };
    },

    created() {
        this.fetchToDoLists();
    },

    methods: {
        fetchToDoLists() {
            let self = this;
            const headers = { 
                "Content-Type": "application/json",
                "Accept": "application/json",
                "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNmRhMWUyY2IzZjEyZDM4YmQ1NzY3YmNmNWZmZmYyNzU0ZDc3ZjNlMTdmNDY1MTcxY2NiNmVkMGNjZDIwMGIyMGM3NmZiMjc2MTU3NWZlMmYiLCJpYXQiOjE1OTQwMjQwNzksIm5iZiI6MTU5NDAyNDA3OSwiZXhwIjoxNjI1NTYwMDc5LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.jjYEqIhZzxHqZHOi_Nbjo6NZ0W-_ESAwTselAbophfpXlp3f893q4zo4NLGd-E8V2_jEvgUdN5i0yYfrGT3FCCi1j1cAfFMQSNQjCuK-RHx4kDxdwmEIsleouqdX1P-m9hXtw_D0-EOe_QJvHHjAPXI1leViXfFEg-2XDkqCdGvGREjkOLdtRQsr7hlsD60egENFrPOQMKaL_V6NW8eI9PsLc-DVnDyEDNOmAQ_D1di0Rk9xk8yIdB744IbPq5-ZPvQuGe9aeBKdR7egzBuVxtdszc513fFBHKtw9AHpQt6gS2og-AsfEY8dwXjTiYMG2HPDqo-dAyMFvP6BOihzISKC2h5jU85-drUQXZzJQeBjrM-VE5BGXZ1WyoiRyH7C3laHO0exd_0E_BESAD0ZVUwt_Ed7pa6gm-lIBGpd1s0btwLSjR6RWau9dH4c4WGfxdiBbUS1ib-ULOnmW-rNTEsXU25UV5QjTdqqX4cfxlW2yNqv_woKYyd3XMMmHqrogm09YHxxAnisWxebRZga1Vr4NN7_BrOyrNoUHUlfH_MzKBQE9Iqfl2CY0oo-CgcvnuRsyBjFioF1sYv36-ACNIJyoC2Yf-YD_VB086AYiiBc9BMlZMroIJO2eoJqHH6lo3f_q5-nTTgumwZKeiIpvj4oniblZTZvoKJEmHdjLzU",
            };
            fetch('api/to-do-lists', { headers })
            .then(res => res.json())
            .then(res => {
                this.toDoLists = res;

                console.log(res);
            })
            .catch(err => console.log(err))
        }
    }
};
</script>
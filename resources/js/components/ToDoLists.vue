<template>
    <div>
        <h4>To Do Lists</h4>

        <form @submit.prevent="addToDoList" class="mb-3">
            <div class="form-group">
                <input
                    type="text"
                    class="form-control"
                    placeholder="Title"
                    v-model="toDoList.title"
                />
            </div>
            <div class="form-group">
                <textarea
                    type="text"
                    class="form-control"
                    placeholder="Description"
                    v-model="toDoList.description"
                ></textarea>
            </div>
            <div class="form-group">
                <input
                    type="text"
                    class="form-control"
                    placeholder="Date and Time"
                    v-model="toDoList.date_time"
                />
            </div>

            <button type="submit" class="btn btn-light btn-block">Save</button>
        </form>

        <div
            class="card card-body"
            v-for="toDoList in toDoLists"
            :key="toDoList.id"
        >
            <h3>{{ toDoList.title }}</h3>
            <p>{{ toDoList.description }}</p>
            <p>{{ toDoList.date_time }}</p>
            <p>{{ toDoList.username }}</p>
            <hr />

            <button
                @click="editToDoList(toDoList)"
                class="btn btn-warning mb-2"
            >
                Edit
            </button>

            <button @click="deleteToDoList(toDoList.id)" class="btn btn-danger">
                Delete
            </button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            toDoLists: [],
            toDoList: {
                id: "",
                title: "",
                description: "",
                date_time: "",
                username: ""
            },
            toDoList_id: "",
            edit: false
        };
    },

    created() {
        if (!localStorage.getItem("user")) {
            this.$router.push("./login");
        } else {
            var user = localStorage.getItem("user");
        }

        this.fetchToDoLists();
    },

    methods: {
        fetchToDoLists() {
            const headers = {
                "Content-Type": "application/json",
                Accept: "application/json",
                Authorization:
                    "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNmRhMWUyY2IzZjEyZDM4YmQ1NzY3YmNmNWZmZmYyNzU0ZDc3ZjNlMTdmNDY1MTcxY2NiNmVkMGNjZDIwMGIyMGM3NmZiMjc2MTU3NWZlMmYiLCJpYXQiOjE1OTQwMjQwNzksIm5iZiI6MTU5NDAyNDA3OSwiZXhwIjoxNjI1NTYwMDc5LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.jjYEqIhZzxHqZHOi_Nbjo6NZ0W-_ESAwTselAbophfpXlp3f893q4zo4NLGd-E8V2_jEvgUdN5i0yYfrGT3FCCi1j1cAfFMQSNQjCuK-RHx4kDxdwmEIsleouqdX1P-m9hXtw_D0-EOe_QJvHHjAPXI1leViXfFEg-2XDkqCdGvGREjkOLdtRQsr7hlsD60egENFrPOQMKaL_V6NW8eI9PsLc-DVnDyEDNOmAQ_D1di0Rk9xk8yIdB744IbPq5-ZPvQuGe9aeBKdR7egzBuVxtdszc513fFBHKtw9AHpQt6gS2og-AsfEY8dwXjTiYMG2HPDqo-dAyMFvP6BOihzISKC2h5jU85-drUQXZzJQeBjrM-VE5BGXZ1WyoiRyH7C3laHO0exd_0E_BESAD0ZVUwt_Ed7pa6gm-lIBGpd1s0btwLSjR6RWau9dH4c4WGfxdiBbUS1ib-ULOnmW-rNTEsXU25UV5QjTdqqX4cfxlW2yNqv_woKYyd3XMMmHqrogm09YHxxAnisWxebRZga1Vr4NN7_BrOyrNoUHUlfH_MzKBQE9Iqfl2CY0oo-CgcvnuRsyBjFioF1sYv36-ACNIJyoC2Yf-YD_VB086AYiiBc9BMlZMroIJO2eoJqHH6lo3f_q5-nTTgumwZKeiIpvj4oniblZTZvoKJEmHdjLzU"
            };
            fetch("api/to-do-lists", { headers })
                .then(res => res.json())
                .then(res => {
                    this.toDoLists = res.data;

                    console.log(this.toDoLists);
                })
                .catch(err => console.log(err));
        },

        addToDoList() {
            const headers = {
                "Content-Type": "application/json",
                Accept: "application/json",
                Authorization:
                    "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNmRhMWUyY2IzZjEyZDM4YmQ1NzY3YmNmNWZmZmYyNzU0ZDc3ZjNlMTdmNDY1MTcxY2NiNmVkMGNjZDIwMGIyMGM3NmZiMjc2MTU3NWZlMmYiLCJpYXQiOjE1OTQwMjQwNzksIm5iZiI6MTU5NDAyNDA3OSwiZXhwIjoxNjI1NTYwMDc5LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.jjYEqIhZzxHqZHOi_Nbjo6NZ0W-_ESAwTselAbophfpXlp3f893q4zo4NLGd-E8V2_jEvgUdN5i0yYfrGT3FCCi1j1cAfFMQSNQjCuK-RHx4kDxdwmEIsleouqdX1P-m9hXtw_D0-EOe_QJvHHjAPXI1leViXfFEg-2XDkqCdGvGREjkOLdtRQsr7hlsD60egENFrPOQMKaL_V6NW8eI9PsLc-DVnDyEDNOmAQ_D1di0Rk9xk8yIdB744IbPq5-ZPvQuGe9aeBKdR7egzBuVxtdszc513fFBHKtw9AHpQt6gS2og-AsfEY8dwXjTiYMG2HPDqo-dAyMFvP6BOihzISKC2h5jU85-drUQXZzJQeBjrM-VE5BGXZ1WyoiRyH7C3laHO0exd_0E_BESAD0ZVUwt_Ed7pa6gm-lIBGpd1s0btwLSjR6RWau9dH4c4WGfxdiBbUS1ib-ULOnmW-rNTEsXU25UV5QjTdqqX4cfxlW2yNqv_woKYyd3XMMmHqrogm09YHxxAnisWxebRZga1Vr4NN7_BrOyrNoUHUlfH_MzKBQE9Iqfl2CY0oo-CgcvnuRsyBjFioF1sYv36-ACNIJyoC2Yf-YD_VB086AYiiBc9BMlZMroIJO2eoJqHH6lo3f_q5-nTTgumwZKeiIpvj4oniblZTZvoKJEmHdjLzU"
            };

            if (this.edit == false) {
                //add
                fetch("api/to-do-lists", {
                    method: "post",
                    headers: headers,
                    body: JSON.stringify(this.toDoList)
                })
                    .then(res => res.json())
                    .then(res => {
                        alert("To do list successfully added.");

                        this.toDoList.title = "";
                        this.toDoList.description = "";
                        this.toDoList.date_time = "";

                        this.fetchToDoLists();
                    })
                    .catch(err => console.log(err));
            } else {
                //update
                const url = new URL(
                    `http://localhost:8000/api/to-do-lists/${this.toDoList.id}`
                );

                const params = {
                    title: this.toDoList.title,
                    description: this.toDoList.description,
                    date_time: this.toDoList.date_time
                };

                Object.entries(params).forEach(([k, v]) =>
                    url.searchParams.append(k, v)
                );

                console.log(url);

                fetch(url, {
                    method: "put",
                    headers: headers
                })
                    .then(res => res.json())
                    .then(res => {
                        alert("To do list successfully updated.");

                        this.toDoList.title = "";
                        this.toDoList.description = "";
                        this.toDoList.date_time = "";

                        this.fetchToDoLists();
                    })
                    .catch(err => console.log(err));
            }
        },

        editToDoList(toDoList) {
            this.edit = true;
            this.toDoList.id = toDoList.id;
            this.toDoList.toDoList_id = toDoList.id;
            this.toDoList.title = toDoList.title;
            this.toDoList.description = toDoList.description;
            this.toDoList.date_time = toDoList.date_time;
        },

        deleteToDoList(id) {
            const headers = {
                "Content-Type": "application/json",
                Accept: "application/json",
                Authorization:
                    "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNmRhMWUyY2IzZjEyZDM4YmQ1NzY3YmNmNWZmZmYyNzU0ZDc3ZjNlMTdmNDY1MTcxY2NiNmVkMGNjZDIwMGIyMGM3NmZiMjc2MTU3NWZlMmYiLCJpYXQiOjE1OTQwMjQwNzksIm5iZiI6MTU5NDAyNDA3OSwiZXhwIjoxNjI1NTYwMDc5LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.jjYEqIhZzxHqZHOi_Nbjo6NZ0W-_ESAwTselAbophfpXlp3f893q4zo4NLGd-E8V2_jEvgUdN5i0yYfrGT3FCCi1j1cAfFMQSNQjCuK-RHx4kDxdwmEIsleouqdX1P-m9hXtw_D0-EOe_QJvHHjAPXI1leViXfFEg-2XDkqCdGvGREjkOLdtRQsr7hlsD60egENFrPOQMKaL_V6NW8eI9PsLc-DVnDyEDNOmAQ_D1di0Rk9xk8yIdB744IbPq5-ZPvQuGe9aeBKdR7egzBuVxtdszc513fFBHKtw9AHpQt6gS2og-AsfEY8dwXjTiYMG2HPDqo-dAyMFvP6BOihzISKC2h5jU85-drUQXZzJQeBjrM-VE5BGXZ1WyoiRyH7C3laHO0exd_0E_BESAD0ZVUwt_Ed7pa6gm-lIBGpd1s0btwLSjR6RWau9dH4c4WGfxdiBbUS1ib-ULOnmW-rNTEsXU25UV5QjTdqqX4cfxlW2yNqv_woKYyd3XMMmHqrogm09YHxxAnisWxebRZga1Vr4NN7_BrOyrNoUHUlfH_MzKBQE9Iqfl2CY0oo-CgcvnuRsyBjFioF1sYv36-ACNIJyoC2Yf-YD_VB086AYiiBc9BMlZMroIJO2eoJqHH6lo3f_q5-nTTgumwZKeiIpvj4oniblZTZvoKJEmHdjLzU"
            };
            if (confirm("Are you sure? ")) {
                fetch(`api/to-do-lists/${id}`, {
                    method: "delete",
                    headers: headers
                })
                    .then(res => res.json())
                    .then(res => {
                        alert("To do list removed.");
                        this.fetchToDoLists();
                    })
                    .catch(err => console.log(err));
            }
        }
    }
};
</script>

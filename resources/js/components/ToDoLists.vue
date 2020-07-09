<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">To do list</div>

                    <div class="card-body">
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

                            <button
                                type="submit"
                                class="btn btn-light btn-block"
                            >
                                Save
                            </button>
                        </form>

                        <div class="card-header">To do lists:</div>
                        <div
                            class="card card-body"
                            v-for="toDoList in toDoLists"
                            :key="toDoList.id"
                        >
                            <h4>{{ toDoList.title }}</h4>
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

                            <button
                                @click="deleteToDoList(toDoList.id)"
                                class="btn btn-danger"
                            >
                                Delete
                            </button>
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
            toDoLists: [],
            toDoList: {
                id: "",
                title: "",
                description: "",
                date_time: "",
                username: ""
            },
            toDoList_id: "",
            edit: false,
            token: ''
        };
    },

    created() {
        if (!localStorage.getItem("user")) {
            this.$router.push("./login");
        } else {
            var user = JSON.parse(localStorage.getItem("user"));

            this.token = user.token;
        }

        this.fetchToDoLists();
    },

    methods: {
        fetchToDoLists() {
            const headers = {
                "Content-Type": "application/json",
                Accept: "application/json",
                Authorization: `Bearer ${this.token}`
            };
            fetch("api/to-do-lists", { headers })
                .then(res => res.json())
                .then(res => {
                    this.toDoLists = res.data;
                })
                .catch(err => console.log(err));
        },

        addToDoList() {
            const headers = {
                "Content-Type": "application/json",
                Accept: "application/json",
                Authorization: `Bearer ${this.token}`
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
                Authorization: `Bearer ${this.token}`};
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

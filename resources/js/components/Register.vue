<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Registration</div>

                    <div class="card-body">
                        <form @submit.prevent="register" class="mb-3">
                            <div class="form-group">
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Name"
                                    v-model="user.name"
                                />
                            </div>
                            <div class="form-group">
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Email"
                                    v-model="user.email"
                                />
                            </div>
                            <div class="form-group">
                                <input
                                    type="password"
                                    class="form-control"
                                    placeholder="Password"
                                    v-model="user.password"
                                />
                            </div>
                            <div class="form-group">
                                <input
                                    type="password"
                                    class="form-control"
                                    placeholder="Confirm Password"
                                    v-model="user.c_password"
                                />
                            </div>

                            <button
                                type="submit"
                                class="btn btn-light btn-block"
                            >
                                Register
                            </button>
                        </form>
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
            user: {
                name: "",
                email: "",
                password: "",
                c_password: ""
            }
        };
    },

    created() {
        if (localStorage.getItem("user")) {
            this.$router.push("./to-do-lists");
        }
    },

    methods: {
        register() {
            const headers = {
                "Content-Type": "application/json",
                Accept: "application/json"
            };

            fetch("api/register", {
                method: "post",
                headers: headers,
                body: JSON.stringify(this.user)
            })
                .then(res => res.json())
                .then(res => {
                    alert("User registered successfully.");

                    localStorage.clear();
                    localStorage.setItem("user", JSON.stringify(res.data));

                    this.$router.push("./to-do-lists");
                })
                .catch(err => console.log(err));
        }
    }
};
</script>

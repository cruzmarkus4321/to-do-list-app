<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Login</div>

                    <div class="card-body">
                        <form @submit.prevent="login" class="mb-3">
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

                            <button
                                type="submit"
                                class="btn btn-light btn-block"
                            >
                                Login
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
                email: "",
                password: ""
            }
        };
    },

    created() {
        if (localStorage.getItem("user")) {
            this.$router.push("./to-do-lists");
        }
    },

    methods: {
        login() {
            const headers = {
                "Content-Type": "application/json",
                Accept: "application/json"
            };

            fetch("api/login", {
                method: "post",
                headers: headers,
                body: JSON.stringify(this.user)
            })
                .then(res => res.json())
                .then(res => {
                    if (res.success) {
                        localStorage.clear();
                        localStorage.setItem("user", JSON.stringify(res.data));
                        
                        this.$router.push("./to-do-lists");
                    }else {
                        alert('Incorrect email or password');
                    }
                })
                .catch(err => console.log(err));
        }
    }
};
</script>

<template>
    <div>
        <h2>Login</h2>

        <form @submit.prevent="login" class="mb-3">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Email" v-model="user.email">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" v-model="user.password">
            </div>
            
            <button type="submit" class="btn btn-light btn-block">Login</button>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            user: {
                email: '',
                password: ''
            }
        };
    },

    methods: {
        login(){
            const headers = { 
                "Content-Type": "application/json",
                "Accept": "application/json"
            };

            fetch('api/login', { 
                    method: 'post',
                    headers: headers,
                    body: JSON.stringify(this.user)
                })
                .then(res => res.json())
                .then(res => {
                    localStorage.clear();
                    localStorage.setItem('user', JSON.stringify(res.data));

                    this.$router.push('./to-do-lists');
                })
                .catch(err => console.log(err));
        }
    }
};
</script>
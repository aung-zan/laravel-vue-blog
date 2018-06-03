<template>
    <div class="container">
        <br>
        <br>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Login Form</div>

                    <div class="card-body">

                        <div class="alert alert-danger alert-dismissible" v-if="error === true">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Error !</strong> {{ errorMessage }}
                        </div>

                        <form v-on:submit.prevent="submitlogin">
                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" v-model="email" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-sm-4 col-form-label text-md-right">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" v-model="password" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>

                                    <router-link :to="{ name: 'register' }" class="btn btn-primary">Register</router-link>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import store from '../store'

    export default {
        data() {
            return {
                email           : '',
                password        : '',
                error           : false,
                errorMessage    : '',
            }
        },
        methods: {
            submitlogin() {
                axios({

                    method      : 'post',
                    url         : '/api/auth/login',
                    data        : {
                        email       : this.email,
                        password    : this.password,
                    }

                }).then(response => {
                    // when success,

                    store.commit('loginUser');
                    localStorage.setItem('token', response.data.access_token);
                    this.$router.push({ name: 'dashboard' });

                }).catch(error => {
                    // when error,

                    this.error          = true;
                    this.errorMessage   = error.response.data;

                });
            }
        }
    }
</script>

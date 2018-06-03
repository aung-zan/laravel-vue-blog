<template>
    <div class="container">
        <br>
        <br>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Register Form</div>

                    <div class="card-body">

                        <div class="alert alert-success alert-dismissible" v-if="error === false">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success !</strong> {{ message }}
                        </div>

                        <div class="alert alert-danger alert-dismissible" v-if="error === true">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Error !</strong> {{ message }}
                        </div>

                        <form v-on:submit.prevent="submitRegister">
                            <div class="form-group row">
                                <label for="name" class="col-sm-4 col-form-label text-md-right">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" v-model="name" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" v-model="email" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="contact_number" class="col-sm-4 col-form-label text-md-right">Contact Number</label>

                                <div class="col-md-6">
                                    <input id="contact_number" type="text" class="form-control" name="contact_number" v-model="contact_number" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="username" class="col-sm-4 col-form-label text-md-right">Username</label>

                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-control" name="username" v-model="username" required autofocus>
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
                                        Register
                                    </button>

                                    <router-link :to="{ name: 'login' }" class="btn btn-primary">Login</router-link>
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
    export default {
        data() {
            return {
                name                : '',
                email               : '',
                contact_number      : '',
                username            : '',
                password            : '',
                error               : null,
                message             : '',
            }
        },
        methods: {
            submitRegister() {
                axios.post('/api/auth/register', {

                    name                : this.name,
                    email               : this.email,
                    contact_number      : this.contact_number,
                    username            : this.username,
                    password            : this.password,

                }).then(response => {

                    this.error = false;
                    this.message = response.data;

                }).catch(response => {

                    this.error = true;
                    this.message = response.data;
                    console.log(response.data);

                });
            }
        }
    }
</script>
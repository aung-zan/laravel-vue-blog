<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">Profile</div>

                <div class="card-body">

                    <div class="alert alert-success alert-dismissible" v-if="error === false">
                        <button class="close" aria-label="close" v-on:click= "error = null">&times;</button>
                        <strong>Success !</strong> {{ message }}
                    </div>

                    <div class="alert alert-danger alert-dismissible" v-if="error === true">
                        <button class="close" aria-label="close" v-on:click= "error = null">&times;</button>
                        <strong>Error !</strong> {{ message }}
                    </div>

                    <form v-on:submit.prevent="submitUpdate">

                        <!-- name -->
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" v-model="name" required autofocus>
                            </div>
                        </div>

                        <!-- email -->
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" v-model="email" required autofocus>
                            </div>
                        </div>

                        <!-- contact_number -->
                        <div class="form-group row">
                            <label for="contact_number" class="col-sm-4 col-form-label text-md-right">Contact Number</label>

                            <div class="col-md-6">
                                <input id="contact_number" type="text" class="form-control" name="contact_number" v-model="contact_number" required autofocus>
                            </div>
                        </div>

                        <!-- username -->
                        <div class="form-group row">
                            <label for="username" class="col-sm-4 col-form-label text-md-right">Username</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" v-model="username" required autofocus>
                            </div>
                        </div>

                        <!-- password -->
                        <div class="form-group row">
                            <label for="password" class="col-sm-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" v-model="password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
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

        // mounted function will work when the component mounted.
        mounted() {
            console.log(localStorage.getItem('token'));
            // get profile function
            axios({
                method              : 'get',
                url                 : '/api/auth/profile',
                headers             : {
                    authorization: 'Bearer ' + localStorage.getItem('token')
                },
                data                : {

                },
            }).then(response => {

                this.name                = response.data.name,
                this.email               = response.data.email,
                this.contact_number      = response.data.contact_number,
                this.username            = response.data.username

            }).catch(error => {

                console.log(error.response);
                this.error      = true
                this.message    = error.response.data.message + '. Please Logout and Login again.'

            });
        },
        methods: {

            // update function
            submitUpdate() {
                axios({
                    method              : 'post',
                    url                 : '/api/auth/update',
                    headers             : {
                        authorization: 'Bearer ' + localStorage.getItem('token')
                    },
                    data                : {
                        name                : this.name,
                        email               : this.email,
                        contact_number      : this.contact_number,
                        username            : this.username,
                    },
                }).then(response => {

                    this.error      = false
                    this.message    = response.data.message

                }).catch(error => {

                    console.log(error.response);
                    this.error      = true
                    this.message    = error.response.data.message + '. Please Logout and Login again.'

                });
            }
        }
    }
</script>
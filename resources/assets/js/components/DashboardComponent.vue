<template>
    <div>
        <nav-component></nav-component>

        <div class="container position">
            <div class="row">
                <div class="col-md-12 col-md-offset-2">
                    <h1>Dashboard</h1>

                    <profile-component></profile-component>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import NavComponent from './NavComponent'
    import ProfileComponent from './ProfileComponent'

    export default {
        components: {
            NavComponent,
            ProfileComponent,
        },
    }
</script>

<style scoped>
    .position {
        margin-top: 5%;
    }
</style>
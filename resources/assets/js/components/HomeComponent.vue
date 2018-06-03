<template>
    <div class="flex-center position-ref full-height">
        <nav-component></nav-component>

        <div class="content">
            <div class="title m-b-md">
                Laravel + Vuejs
            </div>
        </div>
    </div>
</template>

<script>
    import NavComponent from './NavComponent'

    export default {
        components: {
            NavComponent,
          },
    }
</script>
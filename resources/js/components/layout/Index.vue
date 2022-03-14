<template>
    <div>
        <Header/>
        <div class="container">
            <router-view/>
        </div>
    </div>
</template>

<script>
import Header from "./Header";

export default {
    name: "Index",
    components: {Header}
}
</script>

<style scoped>

</style>

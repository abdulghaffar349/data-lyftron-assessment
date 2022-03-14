<template>
    <div class="card mb-3 me-2" style="max-width: 540px;">
        <div class="row no-gutters">
            <div class="col-md-4 p-0">
                <img :src="user.image" class="card-img" :alt="user.name.first">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{ `${user.name.first} ${user.name.last}` }}</h5>
                    <p class="card-text"><small class="text-muted">{{ user.email }}</small></p>
                    <router-link :to="{name:'users.edit',params:{id:user.id}}" class="btn btn-primary">Edit
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "UserInfo",
    props: ["user"]
}
</script>

<style scoped>

</style>

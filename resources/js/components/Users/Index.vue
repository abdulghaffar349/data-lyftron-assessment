<template>
    <div class="row mt-5">
        <div class="d-flex justify-content-end mb-2">
            <button class="btn btn-primary" @click="exportData">Export</button>
        </div>
        <hr/>
        <UserInfo v-for="user in users" :user="user" :key="`users-${user.id}`"/>
        <p v-if="isLoading">Loading...</p>
        <p v-if="pagination.current > pagination.last && !isLoading">No, more results</p>
    </div>
</template>

<script>
import {exportUser, fetchUsers} from "../../services/userService";
import UserInfo from "./Partials/UserInfo";
import {commonMixins} from "../../helpers/mixins";
import {hasScrollbar} from "../../helpers/methods";

export default {
    name: "Index",
    components: {UserInfo},
    mixins: [commonMixins],
    data() {
        return {
            users: [],
            pagination: {
                current: 1,
                last: 1
            },
        }
    },
    created() {
        this.getUsers();
        window.onscroll = () => {
            let bottomOfWindow = document.documentElement.scrollTop + window.innerHeight === document.documentElement.offsetHeight;
            if (bottomOfWindow && this.pagination.current <= this.pagination.last) { //load when scroller on the bottom and there is more page to load
                this.getUsers();
            }
        }
    },
    methods: {
        async getUsers() {
            this.isLoading = true
            const {data: {data, meta}} = await fetchUsers(this.pagination.current);
            this.users = [...this.users, ...data];
            this.pagination = {current: this.pagination.current + 1, last: meta.last_page}
            this.isLoading = false
            this.fetchMoreUser()
        },
        fetchMoreUser() { //get more users when there is no scrollbar but there are more records that need to fetch
            if (this.pagination.last > 1 && !hasScrollbar()) {
                this.getUsers();
            }
        },
        async exportData() {
            const response = await exportUser();
            this.showAlert({title: "", icon: "success", message: response.data.message})
        }
    }
}
</script>

<style scoped>

</style>

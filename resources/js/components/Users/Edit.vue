<template>
    <div class="mt-5">
        <p v-if="isLoading">Loading...</p>
        <form @submit.prevent="update" v-else>
            <fieldset>
                <div class="row">
                    <label class="form-label">Name</label>
                    <div class="col-md-4 mb-3">
                        <select v-model="user.name.title" class="form-select">
                            <option v-for="title in ['Mr','Mrs','Miss']" :key="title" :value="title">{{ title }}
                            </option>
                        </select>
                        <div v-if="errors.has('name.title')" class="error-feedback">
                            {{ errors.get("name.title") }}
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <input type="text" v-model="user.name.first" placeholder="First Name" class="form-control">
                        <div v-if="errors.has('name.first')" class="error-feedback">
                            {{ errors.get("name.first") }}
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <input type="text" v-model="user.name.last" placeholder="Last Name" class="form-control">
                        <div v-if="errors.has('name.last')" class="error-feedback">
                            {{ errors.get("name.last") }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="form-label">Contact</label>
                    <div class="col-md-6 mb-3">
                        <input type="email" v-model="user.email" placeholder="Email" class="form-control">
                        <div v-if="errors.has('email')" class="error-feedback">
                            {{ errors.get("email") }}
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <input type="text" v-model="user.phone" placeholder="Phone" class="form-control">
                        <div v-if="errors.has('phone')" class="error-feedback">
                            {{ errors.get("phone") }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="form-label">Address</label>
                    <div class="mb-3">
                        <input type="text" v-model="user.location" placeholder="Address" class="form-control">
                        <div v-if="errors.has('location')" class="error-feedback">
                            {{ errors.get("location") }}
                        </div>
                    </div>
                </div>
                <button type="submit" :disabled="isUpdating" class="btn btn-primary">Submit</button>
            </fieldset>
        </form>
    </div>
</template>

<script>
import {getById, updateUser} from "../../services/userService";
import {commonMixins} from "../../helpers/mixins";
import {ErrorsHandler} from "../../helpers/ErrorHandler";

export default {
    name: "Edit",
    mixins: [commonMixins],
    data() {
        return {
            user: null,
            isUpdating: false,
            errors: new ErrorsHandler()
        }
    },
    created() {
        this.getUser()
    },
    methods: {
        async getUser() {
            this.isLoading = true;
            try {
                const response = await getById(this.$route.params.id);
                this.user = response.data.data;
            } catch (e) {
                await this.$router.push({name: "users.index"})
            } finally {
                this.isLoading = false;
            }
        },
        async update() {
            this.errors.clear();
            this.isUpdating = true;
            try {
                await updateUser(this.$route.params.id, this.user);
                this.showAlert({title: "Success", icon: "success", message: "User updated successfully!"})
                await this.$router.push({name: "users.index"})
            } catch (e) {
                if (e.response?.data?.errors) this.errors.setErrors(e.response.data.errors);
            } finally {
                this.isUpdating = false;
            }
        }
    }
}
</script>

<style scoped>
.error-feedback {
    width: 100%;
    margin-top: 0.25rem;
    font-size: .875em;
    color: #dc3545;
}
</style>

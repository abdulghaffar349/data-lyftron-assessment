import {get, put} from "./httpService";

/**
 * Get users from the backend
 * @param page
 * @returns {Promise<AxiosResponse<*>>}
 */
const fetchUsers = (page) => get(`/users?page=${page}`);
/**
 * Get user by user id
 * @param userId
 * @returns {Promise<AxiosResponse<*>>}
 */
const getById = (userId) => get(`/users/${userId}`);
/**
 *
 * @param userId
 * @param payload
 * @returns {Promise<AxiosResponse<*>>}
 */
const updateUser = (userId, payload) => put(`/users/${userId}`, payload)
/**
 * export users
 * @returns {Promise<AxiosResponse<*>>}
 */
const exportUser = () => get(`/users/export`)

export {
    fetchUsers,
    getById,
    updateUser,
    exportUser
}

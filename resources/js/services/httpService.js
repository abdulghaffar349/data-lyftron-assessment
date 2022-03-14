import axios from "axios";

const BASE_URL = "http://127.0.0.1:8000/api"

const axiosObject = axios.create({
    baseURL: BASE_URL,
    timeout: 1000,
    headers: {'Accept': 'application/json'}
});
/**
 * Make GET HTTP call to the backend
 * @param url request url
 * @param config pass configuration for current api call/request
 * @returns {Promise<AxiosResponse<any>>}
 */
const get = (url, config = {}) => axiosObject.get(url, config)
/**
 * Make GET HTTP call to the backend
 * @param url request url
 * @param payload pass data to the backend
 * @param config pass configuration for current api call/request
 * @returns {Promise<AxiosResponse<any>>}
 */
const put = (url, payload, config = {}) => axiosObject.put(url, payload, config);

export {
    get,
    put
}
/**
 * NOTE: Here we can add other type of request as well
 */

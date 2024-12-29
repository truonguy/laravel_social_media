import axios from "axios";

const instance = axios.create();
instance.interceptors.request.use(function (config) {
    return config;
});
export default instance

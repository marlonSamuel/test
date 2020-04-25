import Axios from 'axios'

import exampleService from '../services/ExampleService'
import TestService from '../services/TestService'


//let baseUrl = 'http://www.test.com/' //base url desarrollo
let baseUrl = 'http://167.172.158.187/test/' //base production
// Axios Configuration
Axios.defaults.headers.common.Accept = 'application/json'
Axios.defaults.headers.common.Authorization = `bearer `+''

Axios.interceptors.response.use(response => {
    return response
}, error => {
    console.log(error)
    return error
});

export default {
    exampleService: new exampleService(Axios),
    testService: new TestService(Axios,baseUrl)
}
import Vue from 'vue'
import Vuex from 'Vuex'
import services from './services'
import global from '../components/sharedjs/global'

Vue.use(Vuex)

const state = {
    services,
    global,
    //base_url: 'http://www.test.com/',
    base_url: 'http://167.172.158.187/test/'
}

const mutations = {
}

const actions = {
}

export default new Vuex.Store({
    state,
    mutations,
    actions
})
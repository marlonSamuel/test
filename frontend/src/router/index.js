import Vue from 'vue'
import Router from 'vue-router'
import store from '../store/index'
import multiguard from 'vue-router-multiguard'

import Default from '@/components/Default'
import ExampleIndex from '@/components/example/Index'
import Test from '@/components/catalogos/Test'

Vue.use(Router)

const routes = [
    { path: '*', redirect: '/' },
    { path: '/', name: 'Default', component: Default },
    { path: '/example_index', name: 'ExampleIndex', component: ExampleIndex },
    { path: '/test', name:'Test', component: Test}
]


const router = new Router({ routes })

export default router
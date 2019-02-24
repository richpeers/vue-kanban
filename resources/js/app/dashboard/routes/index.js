import {Dashboard} from '../components'

export default [
    {
        path: '/u/:hashId',
        component: Dashboard,
        name: 'dashboard',
        meta: {
            guest: false,
            needsAuth: true
        }
    }
]
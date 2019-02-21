import {Posts} from '../components'

export default [
    {
        path: '/posts',
        component: Posts,
        name: 'posts',
        meta: {
            needsAuth: true
        }
    }
]
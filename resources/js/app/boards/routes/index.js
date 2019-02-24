import {Board} from '../components'

export default [
    {
        path: '/b/:hashId',
        component: Board,
        props: true,
        name: 'board',
        meta: {
            guest: false,
            needsAuth: false
        }
    }
]
import auth from './auth/routes'
import home from './home/routes'

export default [
    ...home,
    ...auth
]
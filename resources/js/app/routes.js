import auth from './auth/routes'
import home from './home/routes'
import posts from './posts/routes'
import errors from './errors/routes'

export default [
    ...home,
    ...auth,
    ...posts,
    ...errors
]
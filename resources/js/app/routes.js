import auth from './auth/routes'
import home from './home/routes'
import dashboard from './dashboard/routes'
import boards from './boards/routes'
import posts from './posts/routes'
import errors from './errors/routes'


export default [
    ...home,
    ...auth,
    ...dashboard,
    ...boards,
    ...posts,
    ...errors
]
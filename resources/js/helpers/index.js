import { isEmpty } from 'lodash'

export const setHttpToken = (token) => {
    if (isEmpty(token)) {
        window.axios.defaults.headers.common['Authorization'] = null
    }

    window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + token
}

export const fetchBoards = ({commit}) => {
    return axios.get('/api/boards').then((response) => {
        commit('setBoards', response.data.data)
    })
};

export const fetchBoard = ({commit}, {payload}) => {
    return axios.get('/api/boards/' + payload.hashId).then((response) => {
        commit('setBoard', response.data.data)
    })
};

export const createBoard = ({commit}, {payload, context}) => {
    return axios.post('/api/boards', payload).then((response) => {
        commit('appendBoard', response.data.data)
    }).catch((error) => {
        context.errors = error.response.data.errors
    })
};

export const deleteBoard = ({commit}, {payload}) => {
    return axios.delete('/api/boards', {params: {'id': payload.id}}).then(() => {
        commit('removeBoard', payload.id)
    })
};

export const createColumn = ({commit, state}, {payload, context}) => {
    return axios.post('/api/columns', {
        'title': payload.title,
        'board_id': state.board.id,
        'order': state.board.columns.length + 1
    }).then((response) => {
        commit('appendColumn', response.data.data)
    }).catch((error) => {
        context.errors = error.response.data.errors
    })
};

export const deleteColumn = ({commit}, {payload}) => {
    return axios.delete('/api/columns', {params: {'id': payload.id}}).then(() => {
        commit('removeColumn', payload.id)
    })
};

export const createCard = ({commit, state}, {payload, context}) => {
    console.log(payload);
    return axios.post('/api/cards', payload).then((response) => {
        commit('appendCard', {columnId: payload.column_id, data: response.data.data})
    }).catch((error) => {
        context.errors = error.response.data.errors
    })
};

export const deleteCard = ({commit}, {payload}) => {
    return axios.delete('/api/cards', {params: {'id': payload.id}}).then(() => {
        commit('removeCard', {columnId: payload.column_id, cardId: payload.id})
    })
};


// export const register = ({dispatch}, {payload, context}) => {
//     return axios.post('/api/register', payload).then((response) => {
//         dispatch('setToken', response.data.meta.token).then(() => {
//             dispatch('fetchUser')
//         })
//     }).catch((error) => {
//         context.errors = error.response.data.errors
//     })
// };
//
// export const login = ({dispatch}, {payload, context}) => {
//     return axios.post('/api/login', payload).then((response) => {
//         dispatch('setToken', response.data.meta.token).then(() => {
//             dispatch('fetchUser')
//         })
//     }).catch((error) => {
//         context.errors = error.response.data.errors
//     })
// };
//
// export const fetchUser = ({commit}) => {
//     return axios.get('/api/me').then((response) => {
//         commit('setAuthenticated', true)
//         commit('setUserData', response.data.data)
//     })
// };
//
// export const logout = ({dispatch}) => {
//     return axios.post('/api/logout').then((response) => {
//         dispatch('clearAuth')
//     })
// };
//
// export const setToken = ({commit, dispatch}, token) => {
//     if (isEmpty(token)) {
//         return dispatch('checkTokenExists').then((token) => {
//             setHttpToken(token)
//         })
//     }
//
//     commit('setToken', token)
//     setHttpToken(token)
// };
//
// export const checkTokenExists = ({commit, dispatch}, token) => {
//     return localforage.getItem('authtoken').then((token) => {
//         if (isEmpty(token)) {
//             return Promise.reject('NO_STORAGE_TOKEN');
//         }
//
//         return Promise.resolve(token)
//     })
// };
//
// export const clearAuth = ({commit}, token) => {
//     commit('setAuthenticated', false)
//     commit('setUserData', null)
//     commit('setToken', null)
//     setHttpToken(null)
// };

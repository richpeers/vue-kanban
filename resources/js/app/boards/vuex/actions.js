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
    return axios.delete('/api/columns/' + payload.id)
        .then(() => commit('removeColumn', payload.id))
};

export const orderColumns = ({commit}, {payload}) => {

    let value = payload.value.map(function (column, columnIndex) {
        column.order = columnIndex + 1;
        column.cards = payload.value[columnIndex].cards.map(function (card, cardIndex) {
            card.order = cardIndex + 1;
            return card
        });
        return column;
    });

    commit('orderColumns', value);

    let columnOrder = payload.value.reduce(function (accum, column) {
        accum[column.id] = {
            order: column.order,
            cards: column.cards.reduce(function (accumCards, card) {
                accumCards[card.id] = card.order;
                return accumCards
            }, {})
        };
        return accum;
    }, {});

    return axios.post('/api/columns/update-order', {
        boardId: payload.board_id,
        columnOrder: columnOrder
    })
};

export const orderCards = ({commit}, {payload}) => {

    commit('orderColumns', payload.value);
};

export const createCard = ({commit, state}, {payload, context}) => {
    return axios.post('/api/cards', payload)
        .then((response) => {
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

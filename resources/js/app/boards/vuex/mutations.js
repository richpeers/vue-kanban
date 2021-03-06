import Vue from 'vue';

export const setBoards = (state, data) => {
    state.personalBoards = data;
};

export const setBoard = (state, data) => {
    state.board = data;
};

export const appendBoard = (state, data) => {
    state.personalBoards.push(data);
};

export const removeBoard = (state, id) => {
    let index = state.personalBoards.findIndex(board => board.id === id);
    state.personalBoards.splice(index, 1)
};

export const appendColumn = (state, data) => {
    state.board.columns.push(data);
};

export const orderCards = (state, {index, value}) => {

    Vue.set(state.board.columns[index], 'cards', value);
};

export const removeColumn = (state, id) => {
    let index = state.board.columns.findIndex(column => column.id === id);
    state.board.columns.splice(index, 1)
};

export const orderColumns = (state, value) => {
    Vue.set(state.board, 'columns', value);
};

export const appendCard = (state, {columnId, data}) => {
    let index = state.board.columns.findIndex(column => column.id === columnId);

    if (!state.board.columns[index].hasOwnProperty('cards')) {
        Vue.set(state.board.columns[index], 'cards', []);
    }

    state.board.columns[index].cards.push(data);
};

export const removeCard = (state, {columnId, cardId}) => {
    let columnIndex = state.board.columns.findIndex(column => column.id === columnId);
    let cardIndex = state.board.columns[columnIndex].cards.findIndex(card => card.id === cardId);
    state.board.columns[columnIndex].cards.splice(cardIndex, 1)
};

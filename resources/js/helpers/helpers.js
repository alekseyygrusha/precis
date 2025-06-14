export function formatDate(date) {
    return new Date(date).toLocaleDateString()
}

export function editStateClass(editIsStart) {
    return editIsStart ? '' : '-edit-ready';
}

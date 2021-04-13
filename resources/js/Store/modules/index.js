import auth from './auth'
import user from './user'
import session from './session'
import card from './card'
import message from './message'
import notification from './notification'
import offer from './offer'

export default {
    namespaced: true,
    modules:
    {
        auth,
        session,
        message,
        card,
        user,
        notification,
        offer
    }
}
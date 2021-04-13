import axios from 'axios'

export default {
  namespaced: true,

  state: {
    notifications: [],
    notificationList: null
  },
  getters:
  {
    notification: state => id => {
      let index = state.notifications.findIndex(n => n.id == id);
      return state.notifications[index];
    },
    notifications: state => {
      return state.notifications;
    },
    sessionNotifications: state => id => {
    return state.notifications.filter(notification => id == notification.session_id);
    },
    notificationsByList: state => list => {
    let sorted = state.notifications.filter( notification => {
        return list.findIndex(list => list.id==notification.id );
      });
      return sorted;
    },
    notificationList (state) {
      return state.notificationList;
    }
  },
  mutations: {
    SET_NOTIFICATIONS (state, value) {
      state.notifications = value;
    },
    SET_NOTIFICATION_LIST (state, value) {
      state.notificationList = value;
    },
    DELETE_NOTIFICATION(state, id){
      //let index = state.notifications.findIndex(s => s.id == id);
      //state.notifications.splice(index, 1);
    },
    SET_ACTIVE_NOTIFICATIONS(state, list)
    {
      state.notificationsByList(list).map(notification => {
        notification['activity_state'] = true;
        return notification;
      });
    },
    ADD_NOTIFICATION (state, notification) {
      state.notifications.push(notification);
      console.log(state.notifications);
    }
  },
  actions:
  {
     
  }
}

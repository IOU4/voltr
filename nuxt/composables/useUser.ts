export interface UserData {
  id?: number
  username?: string,
  email?: string,
  phone?: string,
  password?: string | null,
  created_at?: Date
}

interface UserUserInterface {
  data: UserData,
  token: string | null,
  setUser: (User?: UserData | null) => void
}

const defaultUserData: UserData = {
  id: null,
  username: '',
  email: '',
  phone: '00212',
}

export const useUser: () => UserUserInterface = function() {
  return {
    data: JSON.parse(sessionStorage.getItem('DATA')) || JSON.parse(JSON.stringify(defaultUserData)),
    token: sessionStorage.getItem('TOKEN'),
    setUser(user: UserData = null) {
      if (!user) {
        this.data = defaultUserData;
        sessionStorage.removeItem('TOKEN');
        sessionStorage.removeItem('DATA');
        return;
      }
      this.data = user;
      sessionStorage.setItem('TOKEN', 'token');
      sessionStorage.setItem('DATA', JSON.stringify(user));
    }
  }
}

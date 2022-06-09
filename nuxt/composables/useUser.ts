export interface UserData {
  id?: number
  username?: string,
  email?: string,
  phone?: string,
  password?: string | null,
  created_at?: Date
}

const defaultUserData: UserData = {
  id: null,
  username: '',
  email: '',
  phone: '00212',
}

export const useToken = () => useState<string | null>('tk', () => sessionStorage.getItem('TOKEN'))
export const useUser = () => JSON.parse(sessionStorage.getItem('DATA')) || JSON.parse(JSON.stringify(defaultUserData))

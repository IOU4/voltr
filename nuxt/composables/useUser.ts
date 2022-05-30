export const useToken = () => useState<string | null>('tk', () => sessionStorage.getItem('TOKEN'))
export const useUser = () => {
  return useState<UserData | null>(
    'user',
    () => JSON.parse(sessionStorage.getItem('DATA')) || defaultUserData
  )
}

interface UserData {
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

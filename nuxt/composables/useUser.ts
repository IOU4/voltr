import { AlertType } from "./useAlert"

export interface User {
  id: number,
  username?: string,
  email?: string,
  phone?: string,
  created_at?: Date
}

interface UserInterface {
  data: User,
  token: string | null,
  setUser: (user?: User | null) => void
}

const defaultUserData: User = {
  id: 0,
  username: '',
  email: '',
  phone: '00212',
}

export const useUser: () => UserInterface = () => ({
  data: JSON.parse(sessionStorage.getItem('DATA') || 'null') || defaultUserData,
  token: sessionStorage.getItem('TOKEN'),
  setUser(user) {
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
})

interface Totals {
  items?: number,
  active?: number,
  reserved?: number,
  reservations?: number
}

export async function useUserTotals(userId: number | string) {
  const apiUrl = useApiUrl();
  return await fetch(`${apiUrl}/user/totals?user=${userId}`).then<Totals>(async res => {
    if (res.ok) return await res.json();
    else return {};
  });
}

export async function useGetUser(userId: number | string) {
  const apiUrl = useApiUrl();
  return await fetch(`${apiUrl}/user?id=${userId}`).then<User>(async res => {
    if (res.ok) return await res.json();
    else return {};
  });
}

export async function useGetUsers() {
  const apiUrl = useApiUrl();
  return fetch(`${apiUrl}/users`).then<User[]>(res => {
    if (res.ok) return res.json();
    else return [];
  })
}

export async function useDeleteUser(userId: number | string) {
  const apiUrl = useApiUrl();
  return fetch(`${apiUrl}/user`, {
    method: 'delete',
    body: JSON.stringify({ id: userId })
  }).then(res => {
    const cAlert = useAlert();
    if (res.ok) {
      cAlert.value.showAlert("user deleted successfully!", AlertType.SUCCESS);
    }
    else cAlert.value.showAlert("couldn't delete user!", AlertType.FAIL);
  })
}

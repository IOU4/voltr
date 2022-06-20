import { Item } from "~~/.nuxt/components";
import { AlertType } from "./useAlert";

export enum Categories {
  BOOKS = 'books',
  ELECTRONICS = "electronics"
}

export enum Cities {
  CASABLANCA = 'casablanca',
  RABAT = 'rabat',
  SAFI = 'safi',
  BENI = 'beni-mellal',
  MARAKKECH = 'marakkech',
  AGADIR = 'agadir',
  EL = 'el-jadida',
  TANGER = 'tanger',
  KHMISSAT = 'khmissat',
  OUJDA = 'oujda',
  BERKANE = 'berkane',
  TATA = 'tata',
  ERRACHIDIA = 'errachidia'
}

interface TmpCover {
  name: string,
  file: File,
}

export interface Item {
  id?: number,
  title?: string,
  description?: string,
  author_id?: number,
  author_name?: string,
  author_photo?: string,
  author_phone?: string,
  cover?: string,
  category?: Categories,
  city?: Cities,
  address?: string,
  status?: string,
  created_at?: string,
  updated_at?: string,
  reserver_id?: number,
  reserver_name?: string,
  reserved_at?: string,
  reserve_description?: string,
  reserve_status?: string,
  saved?: boolean | null,
  tmp_cover?: TmpCover[]
}
export const defaultItem: Item = {
  id: 0,
  title: 'books',
  description: 'these books are mostly about french literature, there is 3 of them, in a good condition',
  author_name: 'emadou',
  author_id: 1,
  cover: "2093934.jpeg",
  category: Categories.BOOKS,
  created_at: "2022-05-26 10:59:05",
  updated_at: "2022-05-26 10:59:05"
}

export interface ItemImage {
  id?: number,
  image?: string
}

export interface ReserveData {
  take_at: string,
  description?: string,
}

export const useItem = () => useState<Item>('item', () => JSON.parse(sessionStorage.getItem('ITEM')) ?? defaultItem);
export const useItems = () => useState<Item[]>('items', () => JSON.parse(sessionStorage.getItem('ITEMS')) ?? []);
export const useShowReserve = () => useState<boolean>('showReserve', () => false);

export async function useDeleteItem(itemId: number, isInHome: boolean = false) {
  const apiUrl = useApiUrl();
  const cAlert = useAlert();
  fetch(`${apiUrl}/item`, {
    method: "delete",
    body: JSON.stringify({ id: itemId })
  }).then(res => {
    if (res.ok) {
      cAlert.value.showAlert('item deleted succefully', AlertType.SUCCESS)
      const filter = useFilter();
      isInHome ? useFetchItems() : filter.value.getFiltredItems();
    }
    else cAlert.value.showAlert("couldn't delete item", AlertType.FAIL)
  })
}

export async function useRejectItem(itemId: number, isReject: boolean = true) {
  const filter = useFilter();
  const apiUrl = useApiUrl();
  const cAlert = useAlert();
  fetch(`${apiUrl}/item/${isReject ? 'reject' : 'accept'}`, {
    method: 'post',
    body: JSON.stringify({ item_id: itemId })
  }).then(res => {
    if (res.ok) {
      filter.value.getFiltredItems();
      cAlert.value.showAlert(`The reservation request has been ${isReject ? 'rejected' : 'accepted'}!`, AlertType.SUCCESS);
    } else cAlert.value.showAlert("coudn't complete the operation", AlertType.FAIL);
  })
}
export async function useAcceptItem(itemId: number) { useRejectItem(itemId, false); }

export async function useUpdateItem(updateData: Item, isInHome: boolean = false) {
  const cAlert = useAlert();
  const apiUrl = useApiUrl();
  fetch(`${apiUrl}/item`, {
    method: 'PATCH',
    body: JSON.stringify(updateData),
    headers: {
      "content-type": "application/json"
    }
  }).then(async (res) => {
    if (res.ok) {
      cAlert.value.showAlert('Item updated succefully!', AlertType.SUCCESS);
      const filter = useFilter();
      isInHome ? useFetchItems() : filter.value.getFiltredItems();
      const newItem = await res.json();
      sessionStorage.setItem('ITEM', JSON.stringify(newItem));
      const item = useItem();
      item.value = newItem;
    }
    else cAlert.value.showAlert('error occured!', AlertType.FAIL);
  })
}

export async function useGetCities() {
  const apiUrl = useApiUrl();
  return await fetch(`${apiUrl}/cities`).then(res => res.json()) as Cities[]
}

export async function useGetCategories() {
  const apiUrl = useApiUrl();
  return await fetch(`${apiUrl}/categories`).then(res => res.json()) as Categories[]
}

export async function useFetchItems() {
  const apiUrl = useApiUrl();
  const items = useItems();
  await fetch(`${apiUrl}/items?status=active`).then<Item[]>(res => res.json()).then(data => items.value = data);
}

export async function useItemImages(itemId: number | string) {
  const apiUrl = useApiUrl();
  return await useFetch<ItemImage[]>(`${apiUrl}/item/images?id=${itemId}`).then(res => res.data);
}

export async function useGetItem(itemId: number | string) {
  const apiUrl = useApiUrl();
  const { data: { id: user_id } } = useUser();
  const res = await fetch(`${apiUrl}/item?id=${itemId}&user=${user_id}`).then(res => res.json()) as Item;
  return res;
}

export async function useFetchSavedItems() {
  const apiUrl = useApiUrl();
  const { data: { id: user_id } } = useUser();
  return await fetch(`${apiUrl}/items/saved?user=${user_id}`).then<Item[]>(async res => {
    if (res.ok) return await res.json();
    else return [];
  }) as Item[];
}

export async function useFetchReservedItems() {
  const apiUrl = useApiUrl();
  const { data: { id: user_id } } = useUser();
  return await fetch(`${apiUrl}/items/all_reserved?user=${user_id}`).then<Item[]>(async res => {
    if (res.ok) return await res.json();
    else return [];
  }) as Item[];
}

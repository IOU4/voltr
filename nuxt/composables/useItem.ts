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
  cover?: string,
  category?: Categories,
  city?: Cities,
  address?: string,
  created_at?: string,
  updated_at?: string,
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

export const useItem = () => useState<Item>('item', () => JSON.parse(sessionStorage.getItem('ITEM')) ?? defaultItem);
export const useItems = () => useState<Item[]>('items', () => JSON.parse(sessionStorage.getItem('ITEMS')) ?? []);

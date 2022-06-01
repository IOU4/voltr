export enum Categories {
  BOOKS = 'books',
  ELECTRONICS = "electronics"
}

export interface Item {
  id?: number,
  title?: string,
  description?: string,
  author_id?: number,
  author_name?: string,
  cover?: string,
  category?: Categories,
  created_at?: string,
  updated_at?: string
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

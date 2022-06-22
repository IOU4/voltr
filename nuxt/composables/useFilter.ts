import { Item } from "./useItem"

interface Option {
  label: string,
  value: string
}
const options: Option[] = [
  { label: 'All Items', value: 'all' },
  { label: 'Approval Pending Items', value: 'pending_approve' },
  { label: 'Active/Approved Items', value: 'active' },
  { label: 'Rejected Items', value: 'refused' },
  { label: 'Reserve Pending Items', value: 'pending_reserve' },
  { label: 'Reserved Items', value: 'reserved' }
]


interface FilterState {
  option: string
  filtredItems: Item[]
  setOption: (opt: number) => void,
  getFiltredItems: () => void
}
const apiUrl = useApiUrl();
const { data: { id: user_id } } = useUser();
const FilterObj = {
  option: options[0].value,
  filtredItems: [],
  setOption(opt: number) {
    if (opt >= 0 && opt < options.length) {
      this.optionName = options[opt];
      this.option = opt;
    }
  },
  async getFiltredItems() {
    let res: Item[] = [];
    if (this.option == 'all') res = await fetch(`${apiUrl}/items?user=${user_id}`).then(res => res.json()) as Item[];
    else if (this.option == 'pending_reserve') res = await fetch(`${apiUrl}/items/reserved?user=${user_id}&status=pending&author`).then(res => res.json()) as Item[];
    else res = await fetch(`${apiUrl}/items?user=${user_id}&status=${this.option}`).then(res => res.json()) as Item[];
    this.filtredItems = res
  }
}


interface FilterMenuState {
  isPasswordExpanded: boolean,
  isInfoExpanded: boolean,
  togglePassword: () => void,
  toggleInfo: () => void,
}
const filterMenuObj = {
  isInfoExpanded: false,
  isPasswordExpanded: false,
  toggleInfo() {
    this.isPasswordExpanded = false
    this.isInfoExpanded = !this.isInfoExpanded;
  },
  togglePassword() {
    this.isInfoExpanded = false
    this.isPasswordExpanded = !this.isPasswordExpanded;
  }
}

export const useFilterOptions = () => options
export const useFilter = () => useState<FilterState>('filter', () => FilterObj)
export const useFilterMenu = () => useState<FilterMenuState>('filtermenu', () => filterMenuObj)

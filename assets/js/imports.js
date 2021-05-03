// Bootstrap import
import 'bootstrap/dist/js/bootstrap'
import Vue from 'vue'
import Toast from 'frameworkstylepackage/src/js/Framework/Components/Toast'

import { Ajax } from 'frameworkstylepackage/src/js/Framework/Ajax'
import { Form } from 'frameworkstylepackage/src/js/Framework/Form'
import { GoBack } from 'frameworkstylepackage/src/js/Framework/GoBack'
import { Link } from 'frameworkstylepackage/src/js/Framework/Link'
import { LoadingBar } from 'frameworkstylepackage/src/js/Framework/LoadingBar'
import { Navbar } from 'frameworkstylepackage/src/js/Framework/Navbar'
import { Popover } from 'frameworkstylepackage/src/js/Framework/Popover'
import { Scrolling } from 'frameworkstylepackage/src/js/Framework/Scrolling'
import { SetHeight } from 'frameworkstylepackage/src/js/Framework/SetHeight'
import { Sidebar } from 'frameworkstylepackage/src/js/Framework/Sidebar'
import { Searchbar } from 'frameworkstylepackage/src/js/Framework/Searchbar'
import { Select } from 'frameworkstylepackage/src/js/Framework/Select'
import { Slider } from 'frameworkstylepackage/src/js/Framework/Slider'
import { Sortable } from 'frameworkstylepackage/src/js/Framework/Sortable'
import { Table } from 'frameworkstylepackage/src/js/Framework/Table'
import { Tabs } from 'frameworkstylepackage/src/js/Framework/Tabs'
import { Tooltip } from 'frameworkstylepackage/src/js/Framework/Tooltip'
import FormCollection from 'frameworkstylepackage/src/js/Framework/FormCollection'
import DatePicker from 'frameworkstylepackage/src/js/Framework/DateTimePicker/DatePicker'
import DateTimePicker from 'frameworkstylepackage/src/js/Framework/DateTimePicker/DateTimePicker'
import TimePicker from 'frameworkstylepackage/src/js/Framework/DateTimePicker/TimePicker'
import Clipboard from 'frameworkstylepackage/src/js/Framework/Clipboard'
import { ScrollEvent } from 'frameworkstylepackage/src/js/Framework/ScrollEvent'
import { Theme } from 'frameworkstylepackage/src/js/Framework/Theme'
import { FileInput } from 'frameworkstylepackage/src/js/Framework/FileInput'

export class Framework {
  constructor () {
    this.ajax = new Ajax()
    this.form = new Form()
    this.link = new Link()
    this.loadingBar = new LoadingBar()
    this.navbar = new Navbar()
    this.scrolling = new Scrolling()
    this.setHeight = new SetHeight()
    this.sidebar = new Sidebar()
    this.searchBar = new Searchbar()
    this.table = new Table()
    this.tabs = new Tabs()
    this.goBack = new GoBack()
    this.scrollEvent = new ScrollEvent()
    this.fileInput = new FileInput()
    $(window).on('load', () => {
      this.theme = new Theme()
    })

    Framework.initializeSliders()
    Framework.initializeSortables()
    Framework.initializePopovers()
    Framework.initializeTooltips()
    Framework.initializeSelects()
    Framework.initializeCollections()
    Framework.initializeDateTimePickers()
    Framework.initializeClipboard()
  }

  static initializeSliders () {
    $('.slider').each((index, element) => {
      element.slider = new Slider($(element))
    })
  }

  static initializeSortables () {
    $('.sortable').each((index, element) => {
      element.sortable = new Sortable($(element))
    })
  }

  static initializePopovers () {
    $('[data-toggle="popover"]').each((index, element) => {
      element.popover = new Popover($(element))
    })
  }

  static initializeTooltips () {
    $('[data-toggle="tooltip"]').each((index, element) => {
      element.tooltip = new Tooltip($(element))
    })
  }

  static initializeSelects () {
    $('.select2').each((index, element) => {
      element.select2 = new Select($(element))
    })
  }

  static initializeCollections () {
    $('[data-role="collection"]').each((index, element) => {
      new FormCollection(element)
    })
  }

  static initializeDateTimePickers () {
    $('[data-role="date-time-picker"]').each((index, element) => {
      new DateTimePicker(element).init()
    });

    $('[data-role="date-picker"]').each((index, element) => {
      new DatePicker(element).init()
    });

    $('[data-role="time-picker"]').each((index, element) => {
      new TimePicker(element).init()
    });
  }

  static initializeClipboard () {
    $('[data-role="clipboard"]').each((index, element) => {
      new Clipboard(element)
    });
  }
}

$(window).on('load', () => {
  if ($('#toast-wrapper').length) {
    new Vue({
      el: '#toast-wrapper',
      components: {Toast}
    })
  }
})

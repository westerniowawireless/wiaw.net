primeShortcodeMeta = {
    attributes:[
        {
            label:"Width",
            id:"width",
            help: 'width of the map embed(px or %)'
        },
        {
            label:"Height",
            id:"height",
            help: ' height of the map embed (px or %)'
        },
        {
            label:"Address",
            id:"address",
            help: 'address of the location to display on the map'
        },
        {
            label:"Latitude",
            id:"latitude",
            help: 'the latitude of the location to display on the map (an alternative to providing the address)'
        },
        {
            label:"Longitude",
            id:"longitude",
            help: 'the longitude of the location to display on the map (an alternative to providing the address)'
        },
        {
            label:"Display HTML",
            id:"html",
            help: 'the HTML to display in the popup that is launched when the location marker is clicked'
        },
        {
            label:"Style Class",
            id:"style",
            help: 'CSS class names that you\'d like to add to the map element (can be used to style the map control via CSS).'
        },
        {
            label:"Zoom",
            id:"zoom",
            help:"the initial zoom level of the map",
            controlType:"range-control",
            defaultValue: 8,
            rangeValues:[1, 19]
        },
        {
            label:"Display Pan Control",
            id:"pancontrol",
            help:"whether you want to display the pan control (the large circle with the arrows for moving around)",
            controlType:"select-control",
            selectValues:['false', 'true'],
            defaultValue: 'true',
            defaultText: 'true'
        },
        {
            label:"Display Zoom Control",
            id:"zoomcontrol",
            help:"whether you want to display the zoom control (the plus and minus buttons for zooming in and out)",
            controlType:"select-control",
            selectValues:['false', 'true'],
            defaultValue: 'true',
            defaultText: 'true'
        },
        {
            label:"Display Maptype Control",
            id:"maptypecontrol",
            help:'whether you want to display the map type control (letting the user choose between "map" and "satellite" display)',
            controlType:"select-control",
            selectValues:['false', 'true'],
            defaultValue: 'true',
            defaultText: 'true'
        },
        {
            label:"Display Scale Control",
            id:"scalecontrol",
            help:"whether to display the scale control (the marking that tells you the distances represented in the map).",
            controlType:"select-control",
            selectValues:['false', 'true'],
            defaultValue: 'true',
            defaultText: 'true'
        },
        {
            label:"Display Streetview Control",
            id:"streetviewcontrol",
            help:"Set true to display a Streetview Control",
            controlType:"select-control",
            selectValues:['false', 'true'],
            defaultValue: 'true',
            defaultText: 'true'
        },
        {
            label:"Display Overview Map Control",
            id:"overviewmapcontrol",
            help:" whether to display the overview map control (the arrow in the bottom right corner that expands to show the region currently being viewed).",
            controlType:"select-control",
            selectValues:['false', 'true'],
            defaultValue: 'true',
            defaultText: 'true'
        },
        {
            label:"Display Scroll Wheel",
            id:"scrollwheel",
            help:" whether the map should zoom in and out in response to scrolling via a mouse scrollwheel.",
            controlType:"select-control",
            selectValues:['false', 'true'],
            defaultValue: 'true',
            defaultText: 'true'
        },
        {
            label:"Display Marker",
            id:"marker",
            help:"whether you want to display the red marker showing the location specified by the address or longitude/latitude attributes",
            controlType:"select-control",
            selectValues:['false', 'true'],
            defaultValue: 'true',
            defaultText: 'true'
        },
        {
            label:"Map Type",
            id:"maptype",
            help:"the type of map you want to display (roadmap, satellite, hybrid or terrain).",
            controlType:"select-control",
            selectValues:[
                'ROADMAP', 'SATELLITE', 'HYBRID', 'TERRAIN'],
            defaultValue: 'ROADMAP',
            defaultText: 'ROADMAP (Default)'
        }
    ],
    disablePreview: true,
    shortcode:"gmap"
};
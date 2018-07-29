( function( api ) {

	// Extends our custom "flat-commerce" section.
	api.sectionConstructor['flat-commerce'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );

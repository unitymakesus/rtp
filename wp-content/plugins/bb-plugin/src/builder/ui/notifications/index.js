import React, { Component } from 'react'
import { getSystemActions } from 'data'
import './style.scss'

const renderHTML = rawHTML => React.createElement( 'div', {
	dangerouslySetInnerHTML: { __html: rawHTML }
} )

const lite = FLBuilderConfig.lite

const Post = ( props ) => {
	let html = {
			__html: props.children
		},
		date = new Date( props.date ).toDateString()

	let post
	if ( 'string' === typeof props.url && '' !== props.url ) {
		const url = lite ? props.url + '?utm_medium=bb-lite&utm_source=builder-ui&utm_campaign=notification-center' : props.url + '?utm_medium=bb-pro&utm_source=builder-ui&utm_campaign=notification-center'
		post = (
			<a className="fl-builder-ui-post" href={ url } target="_blank" rel="noopener noreferrer">
				<div className="fl-builder-ui-post-date">{date}</div>
				<div className="fl-builder-ui-post-title">{props.title}</div>
				<div className="fl-builder-ui-post-content" dangerouslySetInnerHTML={ html } />
			</a>
		)
	} else {
		post = (
			<span className="fl-builder-ui-post" >
				<div className="fl-builder-ui-post-date">{date}</div>
				<div className="fl-builder-ui-post-title">{props.title}</div>
				<div className="fl-builder-ui-post-content" dangerouslySetInnerHTML={ html } />
			</span>
		)
	}

	return post
}

/**
 * Notifications Sidebar Panel
 * Displayed when toggleNotifications hook is fired
 */
class NotificationsPanel extends Component {

	getPosts( posts ) {
		let view, renderedPosts,
			strings = FLBuilderStrings.notifications
		if ( 0 < posts.length ) {
			renderedPosts = posts.map( ( item ) => (
				<Post key={ item.id } title={ renderHTML( item.title.rendered ) } date={ item.date } url={ item.meta._fl_notification[0] }>
					{item.content.rendered}
				</Post>
			) )
			view = <>{renderedPosts}</>
		} else {
			view = <div className="fl-panel-no-message">{strings.none}</div>
		}
		return view
	}

	componentDidMount() {
		FLBuilder._initScrollbars()
	}

	componentDidUpdate() {
		FLBuilder._initScrollbars()
	}

	render() {
		const content = this.getPosts( this.props.posts ),
			strings = FLBuilderStrings.notifications

		return (
			<div className="fl-notifications-panel">
				<div className="fl-panel-title">{strings.title}</div>
				<div className="fl-nanoscroller" ref={ this.setupScroller }>
					<div className="fl-nanoscroller-content">{content}</div>
				</div>
			</div>
		)
	}
}

/**
* Non-UI Manager Object. Handles state for the notifications system
*/
export class NotificationsManager extends Component {
	constructor( props ) {
		super( props )

		let out = {}

		const { data } = FLBuilderConfig.notifications

		// make sure we have valid json.
		try {
			out = JSON.parse( data )
		} catch ( e ) {
			out = {}
		}

		this.state = {
			shouldShowNotifications: false,
			posts: out,
		}

		FLBuilder.addHook( 'toggleNotifications', this.onToggleNotifications.bind( this ) )
	}

	onToggleNotifications() {
		const { hideCurrentPanel } = getSystemActions()
		this.setState( { shouldShowNotifications: ! this.state.shouldShowNotifications } )
		hideCurrentPanel()
	}

	render() {
		const { shouldShowNotifications, posts } = this.state

		FLBuilder.triggerHook( 'notificationsLoaded' )

		return shouldShowNotifications && <NotificationsPanel posts={ posts } />
	}
}

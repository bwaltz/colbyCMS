import React, { Component } from "react";
import Menu from "./Menu";
import { Link } from "react-router-dom";
import Toggle from "react-toggle";
import "react-toggle/style.css";
import _xorBy from "lodash/xorBy";
import _remove from "lodash/remove";

// Require Editor JS files.
import "froala-editor/js/froala_editor.pkgd.min.js";
import "froala-editor/js/plugins.pkgd.min.js";

// Require Editor CSS files.
import "froala-editor/css/froala_style.min.css";
import "froala-editor/css/froala_editor.pkgd.min.css";

// Require Font Awesome.
import "font-awesome/css/font-awesome.css";
import FroalaEditor from "react-froala-wysiwyg";

import "./style.scss";

import Modal from "react-modal";
import ReactDiffViewer from "react-diff-viewer";

import MediaLibrary from "./MediaLibrary";

import { toast } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";
import Autosuggest from "react-autosuggest";

import Categories from "./editComponents/Categories";

const Laravel = window.Laravel;

export default class Posts extends Component {
    constructor(props) {
        super(props);
        this.state = {
            post: {},
            loading: true,
            modalIsOpen: false,
            mediaModalIsOpen: false,
            revisionOpen: 0,
            slugRevealed: false,
            groups: [],
            suggestions: [],
            filter: ""
        };

        this.getPost = this.getPost.bind(this);
        this.openModal = this.openModal.bind(this);
        this.closeModal = this.closeModal.bind(this);
        this.openMediaModal = this.openMediaModal.bind(this);
        this.closeMediaModal = this.closeMediaModal.bind(this);
        this.updatePost = this.updatePost.bind(this);
        this.handleModelChange = this.handleModelChange.bind(this);
        this.handlePublishedChange = this.handlePublishedChange.bind(this);
        this.setOpenRevision = this.setOpenRevision.bind(this);
        this.revealSlug = this.revealSlug.bind(this);
        this.disableSlug = this.disableSlug.bind(this);
        this.onSlugChange = this.onSlugChange.bind(this);
        this.selectFeaturedImage = this.selectFeaturedImage.bind(this);
        this.removeGroup = this.removeGroup.bind(this);
        this.getSuggestions = this.getSuggestions.bind(this);
        this.onSuggestionSelect = this.onSuggestionSelect.bind(this);
    }

    componentDidMount() {
        this.getPost();
        this.getGroups();
    }

    getPost() {
        const postId = this.props.match.params.id;
        axios.get(`/api/posts/${postId}`).then(response => {
            this.setState({
                post: response.data.data
            });
        });
    }

    handleModelChange(model) {
        this.setState({
            post: {
                ...this.state.post,
                body: model
            }
        });
    }

    handlePublishedChange() {
        this.setState({
            post: {
                ...this.state.post,
                published: !this.state.post.published
            }
        });
    }

    updatePost() {
        axios
            .put(`/api/posts/${this.props.match.params.id}`, this.state.post)
            .then(response => {
                toast("Success!", {
                    className: "green-background",
                    bodyClassName: "grow-font-size"
                });
                this.setState({
                    post: response.data.data
                });
            });
    }

    openModal() {
        this.setState({
            modalIsOpen: true
        });
    }

    closeModal() {
        this.setState({
            modalIsOpen: false
        });
    }

    openMediaModal() {
        this.setState({
            mediaModalIsOpen: true
        });
    }

    closeMediaModal() {
        this.setState({
            mediaModalIsOpen: false
        });
    }

    setOpenRevision(id) {
        this.setState({
            revisionOpen: id
        });
    }

    revealSlug() {
        this.setState({
            slugRevealed: true
        });
    }

    disableSlug() {
        this.setState({
            slugRevealed: false
        });
    }

    onSlugChange(event) {
        this.setState({
            post: {
                ...this.state.post,
                slug: event.target.value
            }
        });
    }

    selectFeaturedImage(media) {
        axios
            .post(`/api/post/attachMedia/${this.state.post.id}`, {
                file: media.id
            })
            .then(response => {
                this.setState({
                    mediaModalIsOpen: false
                });
                this.getPost();
            });
    }

    getGroups() {
        const postId = this.props.match.params.id;
        axios.get("/api/groups").then(response => {
            this.setState({
                groups: response.data.data,
                loading: false
            });
        });
    }

    getSuggestions(value) {
        const { groups } = this.state;
        const inputValue = value.trim().toLowerCase();
        const inputLength = inputValue.length;

        return inputLength === 0
            ? []
            : _xorBy(this.state.post.groups, groups, "name").filter(group =>
                  group.name.toLowerCase().includes(inputValue)
              );
    }

    onSuggestionSelect(event, { suggestionValue }) {
        const { groups, post } = this.state;
        const groupObj = groups.find(g => g.name === suggestionValue);
        let newGroups = [];
        if (post.groups) {
            newGroups = [...this.state.post.groups, groupObj];
        } else {
            newGroups.push(groupObj);
        }
        this.setState({
            filter: "",
            post: {
                ...this.state.post,
                groups: newGroups
            }
        });
    }

    removeGroup(id) {
        const groups = this.state.post.groups;
        _remove(groups, g => g.id === id);

        this.setState({
            post: {
                ...this.state.post,
                groups
            }
        });
    }

    render() {
        const customStyles = {
            content: {
                top: "50%",
                left: "50%",
                right: "auto",
                bottom: "auto",
                marginRight: "-50%",
                transform: "translate(-50%, -50%)"
            }
        };

        console.log(this.state);
        const postId = this.props.match.params.id;

        const nodes = [
            {
                value: "academics",
                label: "Academics",
                children: [
                    { value: "english", label: "English" },
                    { value: "biology", label: "Biology" }
                ]
            }
        ];

        return (
            <div className="container-fluid">
                <div className="row">
                    <Menu />
                    <main
                        role="main"
                        className="col-md-9 ml-sm-auto col-lg-10 px-4"
                        style={{ paddingTop: "75px" }}
                    >
                        <div className="row">
                            <div className="col-sm-9">
                                <form>
                                    <div className="form-group">
                                        <label htmlFor="title">Title</label>
                                        <input
                                            id="title"
                                            className="form-control"
                                            value={this.state.post.title}
                                        />
                                    </div>
                                    <div className="form-group">
                                        <label htmlFor="body">Body</label>
                                        <FroalaEditor
                                            tag="textarea"
                                            model={this.state.post.body}
                                            onModelChange={
                                                this.handleModelChange
                                            }
                                            config={{
                                                imageUploadURL:
                                                    "http://127.0.0.1:8000/upload",
                                                imageUploadParams: {
                                                    _token: Laravel.csrfToken
                                                }
                                            }}
                                        />
                                    </div>
                                </form>
                            </div>
                            <div className="col-sm-3">
                                <div
                                    style={{
                                        boxShadow: "0 1px 1px rgba(0,0,0,.04)",
                                        border: "1px solid #e5e5e5",
                                        background: "#fff",
                                        marginBottom: "20px"
                                    }}
                                >
                                    <div
                                        style={{
                                            borderBottom: "1px solid #eee",
                                            padding: "10px",
                                            fontSize: " 1.5em"
                                        }}
                                    >
                                        Post Info
                                    </div>
                                    <div style={{ padding: "10px" }}>
                                        <div>
                                            Published:{" "}
                                            {this.state.loading && (
                                                <span>loading...</span>
                                            )}
                                            {!this.state.loading && (
                                                <Toggle
                                                    className="published-toggle"
                                                    defaultChecked={
                                                        this.state.post
                                                            .published
                                                    }
                                                    onChange={
                                                        this
                                                            .handlePublishedChange
                                                    }
                                                    icons={false}
                                                    value={
                                                        this.state.post
                                                            .published
                                                    }
                                                />
                                            )}
                                        </div>
                                        <div>
                                            Revisions:{" "}
                                            {this.state.loading && (
                                                <span>loading...</span>
                                            )}
                                            {!this.state.loading && (
                                                <a
                                                    onClick={this.openModal}
                                                    style={{
                                                        cursor: "pointer",
                                                        color: "#007bff",
                                                        textDecoration:
                                                            "underline"
                                                    }}
                                                >
                                                    {
                                                        this.state.post
                                                            .revisions.length
                                                    }
                                                </a>
                                            )}
                                        </div>
                                        <div>
                                            Slug:{" "}
                                            {!this.state.slugRevealed && (
                                                <a
                                                    onClick={this.revealSlug}
                                                    style={{
                                                        cursor: "pointer",
                                                        color: "#007bff",
                                                        textDecoration:
                                                            "underline"
                                                    }}
                                                >
                                                    {this.state.post.slug}
                                                </a>
                                            )}
                                            {this.state.slugRevealed && (
                                                <span>
                                                    post/
                                                    <input
                                                        id="title"
                                                        onChange={
                                                            this.onSlugChange
                                                        }
                                                        value={
                                                            this.state.post.slug
                                                        }
                                                    />
                                                    <button
                                                        className="btn btn-sm"
                                                        style={{ color: "red" }}
                                                        onClick={
                                                            this.disableSlug
                                                        }
                                                    >
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="24"
                                                            height="24"
                                                            viewBox="0 0 24 24"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            strokeWidth="2"
                                                            strokeLinecap="round"
                                                            strokeLinejoin="round"
                                                            className="feather feather-x"
                                                        >
                                                            <line
                                                                x1="18"
                                                                y1="6"
                                                                x2="6"
                                                                y2="18"
                                                            ></line>
                                                            <line
                                                                x1="6"
                                                                y1="6"
                                                                x2="18"
                                                                y2="18"
                                                            ></line>
                                                        </svg>
                                                    </button>
                                                </span>
                                            )}
                                        </div>
                                        <div>
                                            Visibility:{" "}
                                            <a
                                                onClick={() => {}}
                                                style={{
                                                    cursor: "pointer",
                                                    color: "#007bff",
                                                    textDecoration: "underline"
                                                }}
                                            >
                                                Public
                                            </a>
                                        </div>
                                    </div>
                                    <div
                                        style={{
                                            background: "#f5f5f5",
                                            borderTop: "1px solid #ddd",
                                            padding: "6px"
                                        }}
                                    >
                                        <Link
                                            className="btn btn-link"
                                            style={{ marginRight: "5px" }}
                                            to={`/preview/post/${postId}`}
                                            target="_blank"
                                        >
                                            Preview
                                        </Link>
                                        <button
                                            className="btn btn-secondary"
                                            style={{ marginRight: "5px" }}
                                            onClick={this.updatePost}
                                        >
                                            Save Draft
                                        </button>
                                        {this.state.post.published && (
                                            <button className="btn btn-primary">
                                                Unpublish
                                            </button>
                                        )}
                                        {!this.state.post.published && (
                                            <button className="btn btn-primary">
                                                Publish
                                            </button>
                                        )}
                                    </div>
                                </div>
                                <div
                                    style={{
                                        boxShadow: "0 1px 1px rgba(0,0,0,.04)",
                                        border: "1px solid #e5e5e5",
                                        background: "#fff",
                                        marginBottom: "20px"
                                    }}
                                >
                                    <div
                                        style={{
                                            borderBottom: "1px solid #eee",
                                            padding: "10px",
                                            fontSize: " 1.5em"
                                        }}
                                    >
                                        Featured Image
                                    </div>
                                    <div style={{ padding: "10px" }}>
                                        {!this.state.post.image && (
                                            <i>No featured image</i>
                                        )}
                                        {this.state.post.image && (
                                            <img
                                                src={
                                                    "http://127.0.0.1:8000/storage/uploads/" +
                                                    this.state.post.image
                                                        .filename +
                                                    "." +
                                                    this.state.post.image
                                                        .extension
                                                }
                                                className="card-img-top"
                                                alt="..."
                                            />
                                        )}
                                    </div>
                                    <div
                                        style={{
                                            background: "#f5f5f5",
                                            borderTop: "1px solid #ddd",
                                            padding: "10px"
                                        }}
                                    >
                                        {!this.state.post.image && (
                                            <button
                                                className="btn btn-primary"
                                                onClick={this.openMediaModal}
                                            >
                                                Add
                                            </button>
                                        )}
                                        {this.state.post.image && (
                                            <button
                                                className="btn btn-primary"
                                                onClick={this.openMediaModal}
                                            >
                                                Change
                                            </button>
                                        )}
                                    </div>
                                </div>
                                {!this.state.loading && (
                                    <div
                                        style={{
                                            boxShadow:
                                                "0 1px 1px rgba(0,0,0,.04)",
                                            border: "1px solid #e5e5e5",
                                            background: "#fff",
                                            marginBottom: "20px"
                                        }}
                                    >
                                        <div
                                            style={{
                                                borderBottom: "1px solid #eee",
                                                padding: "10px",
                                                fontSize: " 1.5em",
                                                display: "flex",
                                                justifyContent: "space-between"
                                            }}
                                        >
                                            <div>Groups</div>
                                            <div>
                                                <span class="badge badge-primary">
                                                    {
                                                        this.state.post.groups
                                                            .length
                                                    }
                                                </span>
                                            </div>
                                        </div>
                                        <div style={{ padding: "10px" }}>
                                            <Autosuggest
                                                suggestions={
                                                    this.state.suggestions
                                                }
                                                onSuggestionsFetchRequested={({
                                                    value
                                                }) => {
                                                    this.setState({
                                                        suggestions: this.getSuggestions(
                                                            value
                                                        )
                                                    });
                                                }}
                                                onSuggestionsClearRequested={() => {
                                                    this.setState({
                                                        suggestions: []
                                                    });
                                                }}
                                                getSuggestionValue={group =>
                                                    group.name
                                                }
                                                renderSuggestion={group => (
                                                    <div>{group.name}</div>
                                                )}
                                                inputProps={{
                                                    placeholder: "Group name",
                                                    value: this.state.filter,
                                                    onChange: (
                                                        event,
                                                        { newValue }
                                                    ) => {
                                                        this.setState({
                                                            filter: newValue
                                                        });
                                                    }
                                                }}
                                                onSuggestionSelected={
                                                    this.onSuggestionSelect
                                                }
                                            />
                                        </div>
                                        <div
                                            style={{
                                                padding: "10px"
                                            }}
                                        >
                                            {this.state.post.groups.length >
                                                0 && (
                                                <table className="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">
                                                                Name
                                                            </th>
                                                            <th scope="col">
                                                                Action
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        {this.state.post.groups.map(
                                                            (group, i) => {
                                                                return (
                                                                    <tr key={i}>
                                                                        <td>
                                                                            <Link
                                                                                to={`/admin/posts/${group.id}`}
                                                                            >
                                                                                {
                                                                                    group.name
                                                                                }
                                                                            </Link>
                                                                        </td>
                                                                        <td>
                                                                            <button
                                                                                className="btn btn-sm btn-danger"
                                                                                onClick={this.removeGroup.bind(
                                                                                    null,
                                                                                    group.id
                                                                                )}
                                                                                data-toggle="tooltip"
                                                                                data-placement="top"
                                                                                title="Delete"
                                                                            >
                                                                                <svg
                                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                                    width="24"
                                                                                    height="24"
                                                                                    viewBox="0 0 24 24"
                                                                                    fill="none"
                                                                                    stroke="currentColor"
                                                                                    strokeWidth="2"
                                                                                    strokeLinecap="round"
                                                                                    strokeLinejoin="round"
                                                                                    className="feather feather-x"
                                                                                >
                                                                                    <line
                                                                                        x1="18"
                                                                                        y1="6"
                                                                                        x2="6"
                                                                                        y2="18"
                                                                                    ></line>
                                                                                    <line
                                                                                        x1="6"
                                                                                        y1="6"
                                                                                        x2="18"
                                                                                        y2="18"
                                                                                    ></line>
                                                                                </svg>
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                );
                                                            }
                                                        )}
                                                    </tbody>
                                                </table>
                                            )}
                                            {this.state.post.groups.length ===
                                                0 && (
                                                <div>
                                                    <i>
                                                        Post not restricted to
                                                        groups
                                                    </i>
                                                </div>
                                            )}
                                        </div>
                                    </div>
                                )}
                                {!this.state.loading && <Categories />}
                            </div>
                        </div>
                        {!this.state.loading && (
                            <Modal
                                isOpen={this.state.modalIsOpen}
                                onRequestClose={this.closeModal}
                                style={customStyles}
                                contentLabel="Example Modal"
                                className="post-modal"
                                overlayClassName="post-modal-overlay"
                            >
                                <h2>Revisions</h2>

                                <div
                                    style={{
                                        maxHeight: "600px",
                                        overflow: "auto"
                                    }}
                                >
                                    <div
                                        className="accordion"
                                        id="accordionExample"
                                    >
                                        {this.state.post.revisions
                                            .filter(obj => obj.key === "body")
                                            .map((revision, i) => {
                                                return (
                                                    <div className="card">
                                                        <div className="card-header">
                                                            <h2
                                                                className="mb-0"
                                                                style={{
                                                                    display:
                                                                        "flex",
                                                                    alignItems:
                                                                        "center",
                                                                    justifyContent:
                                                                        "space-between"
                                                                }}
                                                            >
                                                                <button
                                                                    className="btn btn-link"
                                                                    type="button"
                                                                    onClick={this.setOpenRevision.bind(
                                                                        null,
                                                                        i
                                                                    )}
                                                                >
                                                                    {
                                                                        revision.created_at
                                                                    }
                                                                </button>
                                                                <a
                                                                    style={{
                                                                        cursor:
                                                                            "pointer",
                                                                        fontSize:
                                                                            "0.4em",
                                                                        color:
                                                                            "#007bff",
                                                                        textDecoration:
                                                                            "underline"
                                                                    }}
                                                                >
                                                                    Restore
                                                                </a>
                                                            </h2>
                                                        </div>
                                                        <div
                                                            className={`collapse ${
                                                                this.state
                                                                    .revisionOpen ===
                                                                i
                                                                    ? "show"
                                                                    : ""
                                                            }`}
                                                        >
                                                            <div
                                                                className="card-body"
                                                                style={{
                                                                    display:
                                                                        "flex"
                                                                }}
                                                            >
                                                                <ReactDiffViewer
                                                                    oldValue={
                                                                        revision.old_value
                                                                    }
                                                                    newValue={
                                                                        revision.new_value
                                                                    }
                                                                    splitView={
                                                                        true
                                                                    }
                                                                />
                                                            </div>
                                                        </div>
                                                    </div>
                                                );
                                            })}
                                    </div>
                                </div>
                                <div
                                    style={{
                                        textAlign: "end",
                                        marginTop: "1em",
                                        cursor: "pointer"
                                    }}
                                >
                                    <button onClick={this.closeModal}>
                                        close
                                    </button>
                                </div>
                            </Modal>
                        )}
                        <Modal
                            isOpen={this.state.mediaModalIsOpen}
                            onRequestClose={this.closeMediaModal}
                            style={customStyles}
                            contentLabel="Example Modal"
                            className="post-modal"
                            overlayClassName="post-modal-overlay"
                        >
                            <MediaLibrary
                                isPost
                                selectFeaturedImage={this.selectFeaturedImage}
                            />
                        </Modal>
                    </main>
                </div>
            </div>
        );
    }
}

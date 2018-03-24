# Contributing guide

Working on it

## Workflow labels

To allow for asynchronous issue handling, we use [milestones][milestones-page]
and [labels][labels-page]. Leads and product managers handle most of the
scheduling into milestones. Labelling is a task for everyone.

Most issues will have labels for at least one of the following:

- Type: ~"feature proposal", ~bug, ~customer, etc.
- Subject: ~wiki, ~"container registry", ~ldap, ~api, ~frontend, etc.
- Team: ~"CI/CD", ~Discussion, ~Edge, ~Platform, etc.
- Priority: ~Deliverable, ~Stretch, ~"Next Patch Release"

All labels, their meaning and priority are defined on the
[labels page][labels-page].

If you come across an issue that has none of these, and you're allowed to set
labels, you can _always_ add the team and type, and often also the subject.

[milestones-page]: https://gitlab.com/gitlab-org/gitlab-ce/milestones
[labels-page]: https://gitlab.com/gitlab-org/gitlab-ce/labels

### Type labels (~"feature proposal", ~bug, ~customer, etc.)

Type labels are very important. They define what kind of issue this is. Every
issue should have one or more.

Examples of type labels are ~"feature proposal", ~bug, ~customer, ~security,
and ~"direction".

A number of type labels have a priority assigned to them, which automatically
makes them float to the top, depending on their importance.

Type labels are always lowercase, and can have any color, besides blue (which is
already reserved for subject labels).

The descriptions on the [labels page][labels-page] explain what falls under each type label.

### Subject labels (~wiki, ~"container registry", ~ldap, ~api, etc.)

Subject labels are labels that define what area or feature of GitLab this issue
hits. They are not always necessary, but very convenient.

If you are an expert in a particular area, it makes it easier to find issues to
work on. You can also subscribe to those labels to receive an email each time an
issue is labelled with a subject label corresponding to your expertise.

Examples of subject labels are ~wiki, ~"container registry", ~ldap, ~api,
~issues, ~"merge requests", ~labels, and ~"container registry".

Subject labels are always all-lowercase.

### Team labels (~"CI/CD", ~Discussion, ~Edge, ~Platform, etc.)

Team labels specify what team is responsible for this issue.
Assigning a team label makes sure issues get the attention of the appropriate
people.

The current team labels are ~Build, ~"CI/CD", ~Discussion, ~Documentation, ~Edge,
~Geo, ~Gitaly, ~Monitoring, ~Platform, ~Release, ~"Security Products" and ~"UX".

The descriptions on the [labels page][labels-page] explain what falls under the
responsibility of each team.

Within those team labels, we also have the ~backend and ~frontend labels to
indicate if an issue needs backend work, frontend work, or both.

Team labels are always capitalized so that they show up as the first label for
any issue.

### Priority labels (~Deliverable, ~Stretch, ~"Next Patch Release")

Priority labels help us clearly communicate expectations of the work for the
release. There are two levels of priority labels:

- ~Deliverable: Issues that are expected to be delivered in the current
  milestone.
- ~Stretch: Issues that are a stretch goal for delivering in the current
  milestone. If these issues are not done in the current release, they will
  strongly be considered for the next release.
- ~"Next Patch Release": Issues to put in the next patch release. Work on these 
  first, and add the "Pick Into X" label to the merge request, along with the
  appropriate milestone.

Each issue scheduled for the current milestone should be labeled ~Deliverable
or ~"Stretch". Any open issue for a previous milestone should be labeled 
~"Next Patch Release", or otherwise rescheduled to a different milestone.

### Severity labels (~S1, ~S2, etc.)

Severity labels help us clearly communicate the impact of a ~bug on users.

| Label | Meaning                                  | Example |
|-------|------------------------------------------|---------|
| ~S1   | Feature broken, no workaround            | Unable to create an issue |
| ~S2   | Feature broken, workaround unacceptable  | Can create projects, but only via the command line |
| ~S3   | Feature broken, workaround acceptable    | Can add issue to milestone but only via milestone page not from issue |
| ~S4   | Cosmetic issue                           | Photos are not displayed / showing broken link |       

### Label for community contributors (~"Accepting Merge Requests")

Issues that are beneficial to our users, 'nice to haves', that we currently do
not have the capacity for or want to give the priority to, are labeled as
~"Accepting Merge Requests", so the community can make a contribution.

Community contributors can submit merge requests for any issue they want, but
the ~"Accepting Merge Requests" label has a special meaning. It points to
changes that:

1. We already agreed on,
1. Are well-defined,
1. Are likely to get accepted by a maintainer.

We want to avoid a situation when a contributor picks an
~"Accepting Merge Requests" issue and then their merge request gets closed,
because we realize that it does not fit our vision, or we want to solve it in a
different way.

We add the ~"Accepting Merge Requests" label to:

- Low priority ~bug issues (i.e. we do not add it to the bugs that we want to
solve in the ~"Next Patch Release")
- Small ~"feature proposal"
- Small ~"technical debt" issues

After adding the ~"Accepting Merge Requests" label, we try to estimate the
[weight](#issue-weight) of the issue. We use issue weight to let contributors
know how difficult the issue is. Additionally:


If you've decided that you would like to work on an issue, please @-mention
the[appropriate product manager
as soon as possible. The product manager will then pull in appropriate GitLab team
members to further discuss scope, design, and technical considerations. This will
ensure that that your contribution is aligned with the GitLab product and minimize
any rework and delay in getting it merged into master.

GitLab team members who apply the ~"Accepting Merge Requests" label to an issue
should update the issue description with a responsible product manager, inviting
any potential community contributor to @-mention per above.


<?php if (!defined('PO_VERSION')) exit('No direct script access allowed');

/**
 * The main controller class for theme options
 */
class PO_Admin
{
    private $default_options = 'YToxNDc6e3M6MTU6ImdlbmVyYWxfZGVmYXVsdCI7czo3OiJHZW5lcmFsIjtzOjE3OiJwbGFjZWhvbGRlcl9pbWFnZSI7czowOiIiO3M6MTc6InByaW1lX3R3aXR0ZXJfdXNyIjtzOjc6IkBlbnZhdG8iO3M6MTk6Imdvb2dsZV9tYXBzX2FwaV9rZXkiO3M6MDoiIjtzOjIxOiJwcmltZV9zZWFyY2hfc3VidGl0bGUiO3M6Mzk6IkhvcGUgeW91IGZpbmQgd2hhdCB5b3VcJ3JlIGxvb2tpbmcgZm9yISI7czoxMToiZGVtb19oZWFkZXIiO3M6MTE6IkRlbW8gSW1wb3J0IjtzOjExOiJsb2dvX2hlYWRlciI7czo0OiJMb2dvIjtzOjg6ImxvZ29faW1nIjtzOjY3OiJodHRwOi8vZHVpbmNjeXY1Z2w1Yi5jbG91ZGZyb250Lm5ldC91cGxvYWRzLzIwMTIvMDYvbmV4dXMtbG9nbzEucG5nIjtzOjE0OiJsb2dvX2ltZ19oaXJlcyI7czo3MzoiaHR0cDovL2R1aW5jY3l2NWdsNWIuY2xvdWRmcm9udC5uZXQvdXBsb2Fkcy8yMDEyLzA2L25leHVzLWxvZ28taGlyZXMxLnBuZyI7czoxNDoibG9nb19pbWdfd2lkdGgiO3M6MzoiMTU4IjtzOjE1OiJsb2dvX2ltZ19oZWlnaHQiO3M6MjoiNDMiO3M6MTU6Im1vYmlsZV9sb2dvX2ltZyI7czo2NzoiaHR0cDovL2R1aW5jY3l2NWdsNWIuY2xvdWRmcm9udC5uZXQvdXBsb2Fkcy8yMDEyLzA2L25leHVzLWxvZ28xLnBuZyI7czoyMToibW9iaWxlX2xvZ29faW1nX2hpcmVzIjtzOjczOiJodHRwOi8vZHVpbmNjeXY1Z2w1Yi5jbG91ZGZyb250Lm5ldC91cGxvYWRzLzIwMTIvMDYvbmV4dXMtbG9nby1oaXJlczEucG5nIjtzOjIxOiJtb2JpbGVfbG9nb19pbWdfd2lkdGgiO3M6MzoiMTU4IjtzOjIyOiJtb2JpbGVfbG9nb19pbWdfaGVpZ2h0IjtzOjI6IjQzIjtzOjY6ImhlYWRlciI7czo2OiJIZWFkZXIiO3M6MTc6ImhlYWRlcl90b3BfbWFyZ2luIjtzOjA6IiI7czoyMDoiaGVhZGVyX2JvdHRvbV9tYXJnaW4iO3M6MDoiIjtzOjE1OiJsb2dvX3RvcF9tYXJnaW4iO3M6MDoiIjtzOjE4OiJ0YWdsaW5lX3RvcF9tYXJnaW4iO3M6MDoiIjtzOjI1OiJoZWFkZXJfY29udGVudF90b3BfbWFyZ2luIjtzOjA6IiI7czoyMDoiZW5hYmxlX2ZhY2Vib29rX2xpbmsiO2E6MTp7aTowO3M6NjoiRW5hYmxlIjt9czoxMzoiZmFjZWJvb2tfdGV4dCI7czo4OiJGYWNlYm9vayI7czoxMjoiZmFjZWJvb2tfdXJsIjtzOjIzOiJodHRwOi8vd3d3LmZhY2Vib29rLmNvbSI7czoxOToiZW5hYmxlX3R3aXR0ZXJfbGluayI7YToxOntpOjA7czo2OiJFbmFibGUiO31zOjEyOiJ0d2l0dGVyX3RleHQiO3M6NzoiVHdpdHRlciI7czoxMToidHdpdHRlcl91cmwiO3M6MjI6Imh0dHA6Ly93d3cudHdpdHRlci5jb20iO3M6MjA6ImVuYWJsZV9saW5rZWRpbl9saW5rIjthOjE6e2k6MDtzOjY6IkVuYWJsZSI7fXM6MTM6ImxpbmtlZGluX3RleHQiO3M6ODoiTGlua2VkSW4iO3M6MTI6ImxpbmtlZGluX3VybCI7czoyMzoiaHR0cDovL3d3dy5saW5rZWRpbi5jb20iO3M6MTg6ImVuYWJsZV9jYWxsX2J1dHRvbiI7YToxOntpOjA7czo2OiJFbmFibGUiO31zOjE2OiJjYWxsX2J1dHRvbl90ZXh0IjtzOjE5OiJDYWxsIDEuODAwLjU1NS41NTU1IjtzOjE4OiJjYWxsX2J1dHRvbl9udW1iZXIiO3M6MTU6IisxLTgwMC01NTUtNTU1NSI7czoxNToiY2FsbF9idXR0b25fdXJsIjtzOjIxOiJodHRwOi8vd3d3Lmdvb2dsZS5jb20iO3M6MTc6ImFsdGVybmF0ZV9jb250ZW50IjtzOjMxOiI8aDM+U29tZSBBbHRlcm5hdGUgQ29udGVudDwvaDM+IjtzOjI0OiJhbHRlcm5hdGVfY29udGVudF9tb2JpbGUiO3M6Mjg6IjxoMz5Tb21lIEN1c3RvbSBDb250ZW50PC9oMz4iO3M6MjM6Im1vYmlsZV9tZW51X2J1dHRvbl90ZXh0IjtzOjA6IiI7czoxMjoiY29sb3JfaGVhZGVyIjtzOjY6IkNvbG9ycyI7czo0OiJza2luIjtzOjk6IlRlYWwgR3JleSI7czoyMDoiaGVhZGVyX2RpdmlkZXJfY29sb3IiO3M6MDoiIjtzOjIwOiJoZWFkZXJfdGFnbGluZV9jb2xvciI7czowOiIiO3M6MjY6ImhlYWRlcl9mYWNlYm9va19pY29uX2NvbG9yIjtzOjA6IiI7czoyNjoiaGVhZGVyX2ZhY2Vib29rX2xpbmtfY29sb3IiO3M6MDoiIjtzOjI4OiJoZWFkZXJfZmFjZWJvb2tfYnV0dG9uX2NvbG9yIjtzOjA6IiI7czozMzoiaGVhZGVyX2ZhY2Vib29rX2J1dHRvbl9pY29uX2NvbG9yIjtzOjA6IiI7czozMzoiaGVhZGVyX2ZhY2Vib29rX2J1dHRvbl90ZXh0X2NvbG9yIjtzOjA6IiI7czoyNToiaGVhZGVyX3R3aXR0ZXJfaWNvbl9jb2xvciI7czowOiIiO3M6MjU6ImhlYWRlcl90d2l0dGVyX2xpbmtfY29sb3IiO3M6MDoiIjtzOjI3OiJoZWFkZXJfdHdpdHRlcl9idXR0b25fY29sb3IiO3M6MDoiIjtzOjMyOiJoZWFkZXJfdHdpdHRlcl9idXR0b25faWNvbl9jb2xvciI7czowOiIiO3M6MzI6ImhlYWRlcl90d2l0dGVyX2J1dHRvbl90ZXh0X2NvbG9yIjtzOjA6IiI7czoyNjoiaGVhZGVyX2xpbmtlZGluX2ljb25fY29sb3IiO3M6MDoiIjtzOjI2OiJoZWFkZXJfbGlua2VkaW5fbGlua19jb2xvciI7czowOiIiO3M6Mjg6ImhlYWRlcl9saW5rZWRpbl9idXR0b25fY29sb3IiO3M6MDoiIjtzOjMzOiJoZWFkZXJfbGlua2VkaW5fYnV0dG9uX2ljb25fY29sb3IiO3M6MDoiIjtzOjMzOiJoZWFkZXJfbGlua2VkaW5fYnV0dG9uX3RleHRfY29sb3IiO3M6MDoiIjtzOjI0OiJoZWFkZXJfY2FsbF9idXR0b25fY29sb3IiO3M6MDoiIjtzOjI5OiJoZWFkZXJfY2FsbF9idXR0b25faWNvbl9jb2xvciI7czowOiIiO3M6Mjk6ImhlYWRlcl9jYWxsX2J1dHRvbl90ZXh0X2NvbG9yIjtzOjA6IiI7czoxNzoiaGVhZGVyX3RleHRfY29sb3IiO3M6MDoiIjtzOjIxOiJtZW51X2JhY2tncm91bmRfY29sb3IiO3M6MDoiIjtzOjE1OiJtZW51X2l0ZW1fY29sb3IiO3M6MDoiIjtzOjIxOiJtZW51X2l0ZW1faG92ZXJfY29sb3IiO3M6MDoiIjtzOjMyOiJtZW51X2l0ZW1faG92ZXJfYmFja2dyb3VuZF9jb2xvciI7czowOiIiO3M6MjQ6InN1Ym1lbnVfYmFja2dyb3VuZF9jb2xvciI7czowOiIiO3M6MjE6InN1Ym1lbnVfZGl2aWRlcl9jb2xvciI7czowOiIiO3M6MTg6InN1Ym1lbnVfaXRlbV9jb2xvciI7czowOiIiO3M6MjQ6InN1Ym1lbnVfaXRlbV9ob3Zlcl9jb2xvciI7czowOiIiO3M6MzU6InN1Ym1lbnVfaXRlbV9ob3Zlcl9iYWNrZ3JvdW5kX2NvbG9yIjtzOjA6IiI7czoyOToibW9iaWxlX21lbnVfYnV0dG9uX2ljb25fY29sb3IiO3M6MDoiIjtzOjM1OiJtb2JpbGVfbWVudV9idXR0b25fYmFja2dyb3VuZF9jb2xvciI7czowOiIiO3M6MTc6InBsYXlfYnV0dG9uX2NvbG9yIjtzOjA6IiI7czoyMzoicGxheV9idXR0b25faG92ZXJfY29sb3IiO3M6MDoiIjtzOjI0OiJwbGF5X2J1dHRvbl9hY3RpdmVfY29sb3IiO3M6MDoiIjtzOjE4OiJwYXVzZV9idXR0b25fY29sb3IiO3M6MDoiIjtzOjI0OiJwYXVzZV9idXR0b25faG92ZXJfY29sb3IiO3M6MDoiIjtzOjI1OiJwYXVzZV9idXR0b25fYWN0aXZlX2NvbG9yIjtzOjA6IiI7czozMDoicGF1c2VfYnV0dG9uX2FjdGl2ZV9nbG93X2NvbG9yIjtzOjA6IiI7czoxNToicGFnaW5hdG9yX2NvbG9yIjtzOjA6IiI7czoyMToicGFnaW5hdG9yX2hvdmVyX2NvbG9yIjtzOjA6IiI7czoyMzoicGFnaW5hdG9yX2N1cnJlbnRfY29sb3IiO3M6MDoiIjtzOjI2OiJwYWdpbmF0b3JfYmFja2dyb3VuZF9jb2xvciI7czowOiIiO3M6MzU6ImZsZXhzbGlkZXJfY2FwdGlvbl9iYWNrZ3JvdW5kX2NvbG9yIjtzOjA6IiI7czoyOToiZmxleHNsaWRlcl9jYXB0aW9uX3RleHRfY29sb3IiO3M6MDoiIjtzOjMyOiJmbGV4c2xpZGVyX3N1YmNhcHRpb25fdGV4dF9jb2xvciI7czowOiIiO3M6MjE6InN1YmhlYWRlcl90aXRsZV9jb2xvciI7czowOiIiO3M6MjQ6InN1YmhlYWRlcl9zdWJ0aXRsZV9jb2xvciI7czowOiIiO3M6Mjk6InN1YmhlYWRlcl9ib3R0b21fYm9yZGVyX2NvbG9yIjtzOjA6IiI7czoxODoicGFnZV9oZWFkaW5nX2NvbG9yIjtzOjA6IiI7czoxNToicGFnZV90ZXh0X2NvbG9yIjtzOjA6IiI7czoxNToicGFnZV9saW5rX2NvbG9yIjtzOjA6IiI7czoyMDoicGFnZV9mb3JtX2dsb3dfY29sb3IiO3M6MDoiIjtzOjIxOiJwYWdlX2ltYWdlX2dsb3dfY29sb3IiO3M6MDoiIjtzOjEzOiJkaXZpZGVyX2NvbG9yIjtzOjA6IiI7czoxMToicXVvdGVfY29sb3IiO3M6MDoiIjtzOjIxOiJibG9ja3F1b3RlX2xlZnRfY29sb3IiO3M6MDoiIjtzOjI1OiJwcmljaW5nX3BsYW5fYnV0dG9uX2NvbG9yIjtzOjA6IiI7czoyNzoicHJpY2luZ19mZWF0dXJlZF9wbGFuX2NvbG9yIjtzOjA6IiI7czoyNjoicmVjZW50X3Bvc3RzX2RpdmlkZXJfY29sb3IiO3M6MDoiIjtzOjE5OiJjYXRlZ29yeV90ZXh0X2NvbG9yIjtzOjA6IiI7czoyNToiY2F0ZWdvcnlfYmFja2dyb3VuZF9jb2xvciI7czowOiIiO3M6MjU6InBvc3RfbWV0YV9zZXBhcmF0b3JfY29sb3IiO3M6MDoiIjtzOjI0OiJjb21tZW50X2JhY2tncm91bmRfY29sb3IiO3M6MDoiIjtzOjE4OiJjb21tZW50X3RleHRfY29sb3IiO3M6MDoiIjtzOjE4OiJjb21tZW50X2xpbmtfY29sb3IiO3M6MDoiIjtzOjIyOiJwb3J0Zm9saW9fZmlsdGVyX2NvbG9yIjtzOjA6IiI7czoyODoicG9ydGZvbGlvX2ZpbHRlcl9ob3Zlcl9jb2xvciI7czowOiIiO3M6Mjk6InBvcnRmb2xpb19maWx0ZXJfYWN0aXZlX2NvbG9yIjtzOjA6IiI7czoyMToic2lkZWJhcl9oZWFkaW5nX2NvbG9yIjtzOjA6IiI7czoxODoic2lkZWJhcl90ZXh0X2NvbG9yIjtzOjA6IiI7czoxODoic2lkZWJhcl9saW5rX2NvbG9yIjtzOjA6IiI7czoyMDoiZm9vdGVyX2hlYWRpbmdfY29sb3IiO3M6MDoiIjtzOjE3OiJmb290ZXJfdGV4dF9jb2xvciI7czowOiIiO3M6MTc6ImZvb3Rlcl9saW5rX2NvbG9yIjtzOjA6IiI7czoyMDoic3ViZm9vdGVyX3RleHRfY29sb3IiO3M6MDoiIjtzOjIwOiJzdWJmb290ZXJfbGlua19jb2xvciI7czowOiIiO3M6MTc6ImJhY2tncm91bmRfaGVhZGVyIjtzOjExOiJCYWNrZ3JvdW5kcyI7czoxNzoiaGVhZGVyX2JhY2tncm91bmQiO2E6NTp7czoxNjoiYmFja2dyb3VuZC1jb2xvciI7czowOiIiO3M6MTc6ImJhY2tncm91bmQtcmVwZWF0IjtzOjY6InJlcGVhdCI7czoyMToiYmFja2dyb3VuZC1hdHRhY2htZW50IjtzOjU6ImZpeGVkIjtzOjE5OiJiYWNrZ3JvdW5kLXBvc2l0aW9uIjtzOjg6ImxlZnQgdG9wIjtzOjE2OiJiYWNrZ3JvdW5kLWltYWdlIjtzOjA6IiI7fXM6MTU6InBhZ2VfYmFja2dyb3VuZCI7YTo1OntzOjE2OiJiYWNrZ3JvdW5kLWNvbG9yIjtzOjA6IiI7czoxNzoiYmFja2dyb3VuZC1yZXBlYXQiO3M6MDoiIjtzOjIxOiJiYWNrZ3JvdW5kLWF0dGFjaG1lbnQiO3M6MDoiIjtzOjE5OiJiYWNrZ3JvdW5kLXBvc2l0aW9uIjtzOjA6IiI7czoxNjoiYmFja2dyb3VuZC1pbWFnZSI7czowOiIiO31zOjIzOiJwYWdlX2NvbnRlbnRfYmFja2dyb3VuZCI7YTo1OntzOjE2OiJiYWNrZ3JvdW5kLWNvbG9yIjtzOjA6IiI7czoxNzoiYmFja2dyb3VuZC1yZXBlYXQiO3M6MDoiIjtzOjIxOiJiYWNrZ3JvdW5kLWF0dGFjaG1lbnQiO3M6MDoiIjtzOjE5OiJiYWNrZ3JvdW5kLXBvc2l0aW9uIjtzOjA6IiI7czoxNjoiYmFja2dyb3VuZC1pbWFnZSI7czo0NjoiL25vdmEvd3AtY29udGVudC91cGxvYWRzLzIwMTIvMDQvZnVybGV5X2JnLnBuZyI7fXM6MjA6InN1YmhlYWRlcl9iYWNrZ3JvdW5kIjthOjU6e3M6MTY6ImJhY2tncm91bmQtY29sb3IiO3M6MDoiIjtzOjE3OiJiYWNrZ3JvdW5kLXJlcGVhdCI7czowOiIiO3M6MjE6ImJhY2tncm91bmQtYXR0YWNobWVudCI7czowOiIiO3M6MTk6ImJhY2tncm91bmQtcG9zaXRpb24iO3M6MDoiIjtzOjE2OiJiYWNrZ3JvdW5kLWltYWdlIjtzOjA6IiI7fXM6MTg6InNpZGViYXJfYmFja2dyb3VuZCI7YTo1OntzOjE2OiJiYWNrZ3JvdW5kLWNvbG9yIjtzOjA6IiI7czoxNzoiYmFja2dyb3VuZC1yZXBlYXQiO3M6MDoiIjtzOjIxOiJiYWNrZ3JvdW5kLWF0dGFjaG1lbnQiO3M6MDoiIjtzOjE5OiJiYWNrZ3JvdW5kLXBvc2l0aW9uIjtzOjA6IiI7czoxNjoiYmFja2dyb3VuZC1pbWFnZSI7czowOiIiO31zOjE3OiJmb290ZXJfYmFja2dyb3VuZCI7YTo1OntzOjE2OiJiYWNrZ3JvdW5kLWNvbG9yIjtzOjA6IiI7czoxNzoiYmFja2dyb3VuZC1yZXBlYXQiO3M6MDoiIjtzOjIxOiJiYWNrZ3JvdW5kLWF0dGFjaG1lbnQiO3M6MDoiIjtzOjE5OiJiYWNrZ3JvdW5kLXBvc2l0aW9uIjtzOjA6IiI7czoxNjoiYmFja2dyb3VuZC1pbWFnZSI7czowOiIiO31zOjE2OiJmcm9udHBhZ2VfaGVhZGVyIjtzOjEwOiJGcm9udCBQYWdlIjtzOjIxOiJmcm9udF9wYWdlX2Jsb2dfdGl0bGUiO3M6MDoiIjtzOjI0OiJmcm9udF9wYWdlX2Jsb2dfc3VidGl0bGUiO3M6MDoiIjtzOjE4OiJfcHJpbWVfc2xpZGVyX3R5cGUiO3M6MDoiIjtzOjE5OiJfcHJpbWVfc2xpZGVyX29yZGVyIjtzOjA6IiI7czoyMToiX3ByaW1lX3NsaWRlcl9vcmRlcmJ5IjtzOjA6IiI7czoxOToiX3ByaW1lX3NsaWRlcl9zcGVlZCI7czowOiIiO3M6MTQ6InNpZGViYXJfaGVhZGVyIjtzOjE1OiJDdXN0b20gU2lkZWJhcnMiO3M6MjQ6InVubGltaXRlZF9zaWRlYmFyX3NsaWRlciI7YTo0OntpOjA7YTo2OntzOjU6Im9yZGVyIjtzOjE6IjEiO3M6MjoiaWQiO3M6MzY6ImVmMGQyNjQzLTI3YjAtMzFlOS0yODQ5LTI1ODIyYmNmNWE3MiI7czo1OiJ0aXRsZSI7czoxNzoiU2hvcnRjb2RlIFNpZGViYXIiO3M6MTk6InNpZGViYXJfZGVzY3JpcHRpb24iO3M6NTc6IlRoZSBzaWRlYmFyIHRoYXQgc2hvd3MgdXAgb24gdGhlIFNob3J0Y29kZSBleGFtcGxlIHBhZ2VzLiI7czoxMzoic2lkZWJhcl9wYWdlcyI7YTozMDp7aTowO3M6MTA6IkFjY29yZGlvbnMiO2k6MTtzOjY6IkFsZXJ0cyI7aToyO3M6MTA6IkFuaW1hdGlvbnMiO2k6MztzOjI3OiJBdHRlbnRpb24gU2Vla2VyIEFuaW1hdGlvbnMiO2k6NDtzOjI4OiJCb3VuY2luZyBFbnRyYW5jZSBBbmltYXRpb25zIjtpOjU7czoyNDoiQm91bmNpbmcgRXhpdCBBbmltYXRpb25zIjtpOjY7czoyNjoiRmFkaW5nIEVudHJhbmNlIEFuaW1hdGlvbnMiO2k6NztzOjIyOiJGYWRpbmcgRXhpdCBBbmltYXRpb25zIjtpOjg7czoyMToiTGlnaHRzcGVlZCBBbmltYXRpb25zIjtpOjk7czoyODoiUm90YXRpbmcgRW50cmFuY2UgQW5pbWF0aW9ucyI7aToxMDtzOjI0OiJSb3RhdGluZyBFeGl0IEFuaW1hdGlvbnMiO2k6MTE7czoxODoiU3BlY2lhbCBBbmltYXRpb25zIjtpOjEyO3M6MTk6IkJsb2NrICYgUHVsbCBRdW90ZXMiO2k6MTM7czo3OiJCdXR0b25zIjtpOjE0O3M6NzoiQ29sdW1ucyI7aToxNTtzOjg6IkRpdmlkZXJzIjtpOjE2O3M6ODoiRHJvcGNhcHMiO2k6MTc7czoxMDoiRmxleHNsaWRlciI7aToxODtzOjc6IkdhbGxlcnkiO2k6MTk7czoxMToiR29vZ2xlIE1hcHMiO2k6MjA7czo4OiJNZXNzYWdlcyI7aToyMTtzOjE4OiJSZXNwb25zaXZlIERpc3BsYXkiO2k6MjI7czoxNjoiUmVzcG9uc2l2ZSBJbWFnZSI7aToyMztzOjIzOiJSZXNwb25zaXZlIFZpZGVvIEVtYmVkcyI7aToyNDtzOjE0OiJTb2NpYWwgU2hhcmluZyI7aToyNTtzOjExOiJTdHlsZWQgTGlzdCI7aToyNjtzOjEyOiJTdHlsZWQgVGFibGUiO2k6Mjc7czo0OiJUYWJzIjtpOjI4O3M6NzoiVG9nZ2xlcyI7aToyOTtzOjEwOiJUeXBvZ3JhcGh5Ijt9czoxODoic2lkZWJhcl9jYXRlZ29yaWVzIjthOjA6e319aToxO2E6Njp7czo1OiJvcmRlciI7czoxOiIyIjtzOjI6ImlkIjtzOjM2OiI0MjZlZTZkNC03NzU3LTk1MDktMDllZi03MWQ1MGY3ZWRlYTQiO3M6NToidGl0bGUiO3M6MjI6IlBvcnRmb2xpbyBJdGVtIFNpZGViYXIiO3M6MTk6InNpZGViYXJfZGVzY3JpcHRpb24iO3M6NDM6IlRoZSBzaWRlYmFyIHRoYXQgYXBwZWFycyBvbiBwb3J0Zm9saW8gaXRlbXMiO3M6MTM6InNpZGViYXJfcGFnZXMiO2E6MTp7aTowO3M6MjI6IkV4YW1wbGUgUG9ydGZvbGlvIEl0ZW0iO31zOjE4OiJzaWRlYmFyX2NhdGVnb3JpZXMiO2E6MDp7fX1pOjI7YTo2OntzOjU6Im9yZGVyIjtzOjE6IjMiO3M6MjoiaWQiO3M6MzY6ImRiN2M4MWIyLWU2NmMtM2MwNS1kMjYzLTI0MDczMWI4MzY1MyI7czo1OiJ0aXRsZSI7czoyMDoiQ29udGFjdCBQYWdlIFNpZGViYXIiO3M6MTk6InNpZGViYXJfZGVzY3JpcHRpb24iO3M6NDU6IlRoZSBzaWRlYmFyIHRoYXQgYXBwZWFycyBvbiB0aGUgQ29udGFjdCBQYWdlLiI7czoxMzoic2lkZWJhcl9wYWdlcyI7YToxOntpOjA7czoxMDoiQ29udGFjdCBVcyI7fXM6MTg6InNpZGViYXJfY2F0ZWdvcmllcyI7YTowOnt9fWk6MzthOjY6e3M6NToib3JkZXIiO3M6MToiNCI7czoyOiJpZCI7czozNjoiNWZhZTRlY2EtZTUxNy1jMDY1LWI2YjQtMTc4ZTNhNjExMjgwIjtzOjU6InRpdGxlIjtzOjIxOiJTZXJ2aWNlcyBQYWdlIFNpZGViYXIiO3M6MTk6InNpZGViYXJfZGVzY3JpcHRpb24iO3M6NDY6IlRoZSBzaWRlYmFyIHRoYXQgYXBwZWFycyBvbiB0aGUgU2VydmljZXMgUGFnZS4iO3M6MTM6InNpZGViYXJfcGFnZXMiO2E6Mjp7aTowO3M6ODoiQWJvdXQgVXMiO2k6MTtzOjEzOiJTZXJ2aWNlcyBQYWdlIjt9czoxODoic2lkZWJhcl9jYXRlZ29yaWVzIjthOjA6e319fXM6MTY6InBvcnRmb2xpb19oZWFkZXIiO3M6MTA6IlBvcnRmb2xpb3MiO3M6MjU6InBvcnRmb2xpb19pbnN0YW5jZV9zbGlkZXIiO2E6NDp7aTowO2E6MTE6e3M6NToib3JkZXIiO3M6MToiMiI7czoyOiJpZCI7czozNjoiY2ZmMzczYWEtZTdiYS0zNGY5LTlkYWEtNzIyZmYxNjc2ZjBjIjtzOjU6InRpdGxlIjtzOjE1OiJpbWFnZS1wb3J0Zm9saW8iO3M6MTQ6InBvcnRmb2xpb19wYWdlIjtzOjE1OiJJbWFnZSBQb3J0Zm9saW8iO3M6MjA6InBvcnRmb2xpb19jYXRlZ29yaWVzIjthOjE6e2k6MDtzOjE1OiJJbWFnZSBQb3J0Zm9saW8iO31zOjIyOiJwb3J0Zm9saW9fc2hvd19maWx0ZXJzIjthOjE6e2k6MDtzOjM6IlllcyI7fXM6MTc6InBvcnRmb2xpb19maWx0ZXJzIjthOjc6e2k6MDtzOjEzOiJBcnQgRGlyZWN0aW9uIjtpOjE7czo1OiJBdWRpbyI7aToyO3M6MTE6IkRldmVsb3BtZW50IjtpOjM7czoxNDoiR3JhcGhpYyBEZXNpZ24iO2k6NDtzOjE1OiJNb3Rpb24gR3JhcGhpY3MiO2k6NTtzOjEyOiJQcmludCBEZXNpZ24iO2k6NjtzOjEwOiJXZWIgRGVzaWduIjt9czoyNDoicG9ydGZvbGlvX3Bvc3RzX3Blcl9wYWdlIjtzOjA6IiI7czoyMzoicG9ydGZvbGlvX3JlYWRtb3JlX3RleHQiO3M6MDoiIjtzOjE1OiJwb3J0Zm9saW9fb3JkZXIiO3M6MzoiQVNDIjtzOjE3OiJwb3J0Zm9saW9fb3JkZXJieSI7czowOiIiO31pOjE7YToxMTp7czo1OiJvcmRlciI7czoxOiIyIjtzOjI6ImlkIjtzOjM2OiJkMzUyZDU5OS05MTg2LTIxNWMtNTY5Yi05NzA4YzJjY2RmNDEiO3M6NToidGl0bGUiO3M6MTU6InZpZGVvLXBvcnRmb2xpbyI7czoxNDoicG9ydGZvbGlvX3BhZ2UiO3M6MTU6IlZpZGVvIFBvcnRmb2xpbyI7czoyMDoicG9ydGZvbGlvX2NhdGVnb3JpZXMiO2E6MTp7aTowO3M6MTU6IlZpZGVvIFBvcnRmb2xpbyI7fXM6MjI6InBvcnRmb2xpb19zaG93X2ZpbHRlcnMiO2E6MTp7aTowO3M6MzoiWWVzIjt9czoxNzoicG9ydGZvbGlvX2ZpbHRlcnMiO2E6Nzp7aTowO3M6MTM6IkFydCBEaXJlY3Rpb24iO2k6MTtzOjU6IkF1ZGlvIjtpOjI7czoxMToiRGV2ZWxvcG1lbnQiO2k6MztzOjE0OiJHcmFwaGljIERlc2lnbiI7aTo0O3M6MTU6Ik1vdGlvbiBHcmFwaGljcyI7aTo1O3M6MTI6IlByaW50IERlc2lnbiI7aTo2O3M6MTA6IldlYiBEZXNpZ24iO31zOjI0OiJwb3J0Zm9saW9fcG9zdHNfcGVyX3BhZ2UiO3M6MDoiIjtzOjIzOiJwb3J0Zm9saW9fcmVhZG1vcmVfdGV4dCI7czowOiIiO3M6MTU6InBvcnRmb2xpb19vcmRlciI7czozOiJBU0MiO3M6MTc6InBvcnRmb2xpb19vcmRlcmJ5IjtzOjQ6ImRhdGUiO31pOjI7YToxMDp7czo1OiJvcmRlciI7czoxOiIzIjtzOjI6ImlkIjtzOjM2OiIxYWU4MTM3Yy05N2Y0LThmNWQtYmJmMC0xNGIyNWUyZWRkZmEiO3M6NToidGl0bGUiO3M6MTk6InBvcnRmb2xpby1uby1maWx0ZXIiO3M6MTQ6InBvcnRmb2xpb19wYWdlIjtzOjI1OiJQb3J0Zm9saW8gV2l0aG91dCBGaWx0ZXJzIjtzOjIwOiJwb3J0Zm9saW9fY2F0ZWdvcmllcyI7YToxOntpOjA7czoxNToiSW1hZ2UgUG9ydGZvbGlvIjt9czoyNDoicG9ydGZvbGlvX3Bvc3RzX3Blcl9wYWdlIjtzOjA6IiI7czoyMzoicG9ydGZvbGlvX3JlYWRtb3JlX3RleHQiO3M6MDoiIjtzOjE1OiJwb3J0Zm9saW9fb3JkZXIiO3M6MzoiQVNDIjtzOjE3OiJwb3J0Zm9saW9fb3JkZXJieSI7czowOiIiO3M6MTc6InBvcnRmb2xpb19maWx0ZXJzIjthOjA6e319aTozO2E6MTE6e3M6NToib3JkZXIiO3M6MToiNCI7czoyOiJpZCI7czozNjoiMWY1YzJlMDktYjFjOS1kMmRlLTEzOGYtNTMyOWUyYjE2NTE4IjtzOjU6InRpdGxlIjtzOjE3OiJnYWxsZXJ5LXBvcnRmb2xpbyI7czoxNDoicG9ydGZvbGlvX3BhZ2UiO3M6MTc6IkdhbGxlcnkgUG9ydGZvbGlvIjtzOjIwOiJwb3J0Zm9saW9fY2F0ZWdvcmllcyI7YToxOntpOjA7czoxNzoiR2FsbGVyeSBQb3J0Zm9saW8iO31zOjIyOiJwb3J0Zm9saW9fc2hvd19maWx0ZXJzIjthOjE6e2k6MDtzOjM6IlllcyI7fXM6MTc6InBvcnRmb2xpb19maWx0ZXJzIjthOjc6e2k6MDtzOjEzOiJBcnQgRGlyZWN0aW9uIjtpOjE7czo1OiJBdWRpbyI7aToyO3M6MTE6IkRldmVsb3BtZW50IjtpOjM7czoxNDoiR3JhcGhpYyBEZXNpZ24iO2k6NDtzOjE1OiJNb3Rpb24gR3JhcGhpY3MiO2k6NTtzOjEyOiJQcmludCBEZXNpZ24iO2k6NjtzOjEwOiJXZWIgRGVzaWduIjt9czoyNDoicG9ydGZvbGlvX3Bvc3RzX3Blcl9wYWdlIjtzOjA6IiI7czoyMzoicG9ydGZvbGlvX3JlYWRtb3JlX3RleHQiO3M6MDoiIjtzOjE1OiJwb3J0Zm9saW9fb3JkZXIiO3M6MzoiQVNDIjtzOjE3OiJwb3J0Zm9saW9fb3JkZXJieSI7czowOiIiO319czoxNToiYWxsX2ZpbHRlcl90ZXh0IjtzOjg6IlNob3cgQWxsIjtzOjEzOiJmb290ZXJfaGVhZGVyIjtzOjY6IkZvb3RlciI7czoxOToic3ViZm9vdGVyX2xlZnRfdGV4dCI7czozODoiQ29weXJpZ2h0IMKpMjAxMS4gQWxsIFJpZ2h0cyBSZXNlcnZlZC4iO3M6MTQ6ImV4Y2VycHRfaGVhZGVyIjtzOjg6IkV4Y2VycHRzIjtzOjIzOiJhcmNoaXZlc19leGNlcnB0X2xlbmd0aCI7czozOiI0MDAiO3M6Mjc6InJlY2VudF9wb3N0c19leGNlcnB0X2xlbmd0aCI7czozOiIxMjAiO3M6Mjc6ImV4Y2VycHRfY29udGludWF0aW9uX3N0cmluZyI7czozOiIuLi4iO3M6MTA6ImN1c3RvbV9jc3MiO3M6MTA6IkN1c3RvbSBDU1MiO3M6MTU6ImN1c3RvbV9jc3NfY29kZSI7czo5MzoiaDEsIGgyLCBoMywgaDQsIHNwYW4ucHVsbHF1b3RlLCBibG9ja3F1b3RlLCAuZHJvcGNhcCB7DQogICAgZm9udC1mYW1pbHk6IFwiT3BlbiBTYW5zXCI7DQp9IA0KIjtzOjEyOiJnb29nbGVfZm9udHMiO3M6NToiRm9udHMiO3M6MTA6ImZvbnRfc3RhY2siO3M6NDQ6IkhlbHZldGljYSBOZXVlLCBIZWx2ZXRpY2EsIEFyaWFsLCBzYW5zLXNlcmlmIjtzOjk6ImZvbnRfc2l6ZSI7czoyOiIxMyI7czoxNzoiZ29vZ2xlX2ZvbnRfbGlua3MiO3M6MTIzOiI8bGluayBocmVmPVwnaHR0cDovL2ZvbnRzLmdvb2dsZWFwaXMuY29tL2Nzcz9mYW1pbHk9T3BlbitTYW5zOjMwMCwzMDBpdGFsaWMsNDAwLDMwMFwnIHJlbD1cJ3N0eWxlc2hlZXRcJyB0eXBlPVwndGV4dC9jc3NcJz4iO30=';
    private $show_docs;
    private $option_array;
    private $version;

    private $schemaFactory;

    /**
     * PHP4 contructor
     *
     * @since 1.1.6
     */
    function PO_Admin()
    {
        $this->__construct();
    }

    /**
     * PHP5 contructor
     *
     * @since 1.0.0
     */
    function __construct()
    {
        global $theme_options_schema_factory;

        $this->schemaFactory = $theme_options_schema_factory;

        $this->option_array = $this->schemaFactory->get_schema_object();
        $this->version = '0.0.1';
    }

    function option_tree_admin()
    {
        // create menu item
        $blog_name = get_option('blogname');
        $option_tree_options = add_theme_page('Options',
            'Theme Options',
            'edit_theme_options',
            'prime_options_option_tree',
            array($this, 'option_tree_options_page'));

        // add menu item
        add_action("admin_print_styles-$option_tree_options", array($this, 'option_tree_load'));

        //Register the Import and Export Development help page
        if (PRIME_DEVELOPMENT_MODE) {
            $option_tree_settings = add_theme_page('Option Settings',
                'Options Import & Export',
                'edit_theme_options',
                'prime_options_option_tree_settings',
                array($this, 'option_tree_settings_page'));

            add_action("admin_print_styles-$option_tree_settings", array($this, 'option_tree_load'));
        }

    }

    /**
     * Theme Options Page
     *
     * @uses get_option()
     * @uses get_option_page_ID()
     * @uses option_tree_check_post_lock()
     * @uses option_tree_check_post_lock()
     * @uses option_tree_notice_post_locked()
     *
     * @access public
     * @since 1.0.0
     *
     * @return string
     */
    function option_tree_options_page()
    {
        // hook before page loads
        do_action('option_tree_admin_header');

        // set
        $ot_array = $this->option_array;

        // load saved option_tree
        $settings = get_option(PRIME_OPTIONS_KEY);

        // Load Saved Layouts
        $layouts = get_option('option_tree_layouts');

        // private page ID
        $post_id = $this->get_option_page_ID('media');

        // set post lock
        if ($last = $this->option_tree_check_post_lock($post_id)) {
            $message = $this->option_tree_notice_post_locked($post_id);
        }
        else
        {
            $this->option_tree_set_post_lock($post_id);
        }

        // Grab Options Page
        include(PO_PLUGIN_DIR . '/front-end/prime-options.php');
    }

    /**
     * Settings Page
     *
     * @uses get_option()
     * @uses get_option_page_ID()
     * @uses option_tree_check_post_lock()
     * @uses option_tree_check_post_lock()
     * @uses option_tree_notice_post_locked()
     *
     * @access public
     * @since 1.0.0
     *
     * @return string
     */
    function option_tree_settings_page()
    {
        // hook before page loads
        do_action('option_tree_admin_header');

        // set
        $ot_array = $this->option_array;

        // Load Saved Options
        $settings = get_option(PRIME_OPTIONS_KEY);
        $exportString = $this->getExportString();

        // Load Saved Layouts
        $layouts = get_option('option_tree_layouts');

        // private page ID
        $post_id = $this->get_option_page_ID('options');

        // set post lock
        if ($last = $this->option_tree_check_post_lock($post_id)) {
            $message = $this->option_tree_notice_post_locked($post_id);
        }
        else
        {
            $this->option_tree_set_post_lock($post_id);
        }

        // Get Settings Page
        include(PO_PLUGIN_DIR . '/front-end/prime-settings.php');
    }

    function prime_options_import_demo()
    {
        // Check AJAX Referer
        check_ajax_referer('_theme_options', '_ajax_nonce');


        require_once get_template_directory() . '/prime-option/classes/prime-importer.php';

        //instantiate prime-importer
        $wp_import = new PrimeImport();
        ob_start();

        //load demo.xml
        $wp_import->fetch_attachments = true;
        $xml_path = get_template_directory() . '/demo/demo.xml';

        $wp_import->import($xml_path);

        //load demo.php options
        require_once get_template_directory() . '/demo/demo.php';

        // Unserialize The Array
        $new_options = $this->decodeSettings($serialized_demo_options);

        // check if array()
        if (is_array($new_options)) {
            $this->import_new_options($new_options);
        }

        //load menus
        // automatically create menus and set their locations
        // add all pages to the Primary Navigation
        //Parameterize with the menu to look for when assigning the theme location a menu
        $primary_nav = wp_get_nav_menu_object('header-desktop');
        $table_nav = wp_get_nav_menu_object('header-tablet');

        $primary_nav_term_id = (int)$primary_nav->term_id;
        $menu_items = wp_get_nav_menu_items($primary_nav_term_id);
        if (!$menu_items || empty($menu_items)) {
            $pages = get_pages();
            foreach ($pages as $page) {
                $item = array(
                    'menu-item-object-id' => $page->ID,
                    'menu-item-object' => 'page',
                    'menu-item-type' => 'post_type',
                    'menu-item-status' => 'publish'
                );
                wp_update_nav_menu_item($primary_nav_term_id, 0, $item);
            }
        }

        //actually set the menu values
        $locations = get_theme_mod('nav_menu_locations');
        $locations['primary_navigation'] = $primary_nav_term_id; //$foo is term_id of menu
        $locations['tablet_navigation'] = $table_nav->term_id;
        $locations['tablet_navigation_landscape'] = $table_nav->term_id;
        $locations['mobile_navigation'] = $primary_nav_term_id; //$foo is term_id of menu

        set_theme_mod('nav_menu_locations', $locations);

        //setup Reading Settings
        update_option('show_on_front', 'page');
        $home_page = get_page_by_title('Home');
        if ($home_page->post_type == 'page') update_option('page_on_front', $home_page->ID);

        $blog_page = get_page_by_title('Our Cool Blog');
        if ($blog_page->post_type == 'page') update_option('page_for_posts', $blog_page->ID);

        update_option('blogdescription', 'A WP Site');

        ob_end_clean();

        echo 'All Done! Demo content has been imported. Please wait for page reload.';
        die();
    }

    function updateUploadURLs(&$settings, $wp_import)
    {
        $prime_elements = $this->schemaFactory->get_schema_array();
        foreach ($prime_elements as $element) {
            $item_type = $element['item_type'];
            $item_id = $element['item_id'];

            //if there's a value set
            if (isset($settings[$element['item_id']])) {
                switch ($item_type) {
                    case 'upload':
                        $settings[$item_id] = $this->localizeUrl($settings[$item_id], $wp_import);
                }
            }
        }
    }

    function localizeUrl($url, $wp_import)
    {
        _log('localize Url: ' . $url);
        $url_remap = $wp_import->url_remap;
        _log('map to: ' . $url_remap[$url]);

        if (isset($url_remap[$url]))
            return $url_remap[$url];
        else return $url;
    }

    /**
     * ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     * Export Helper Functions
     * ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     */

    /**
     * @return string
     */
    function getExportString()
    {
        $settings = get_option(PRIME_OPTIONS_KEY) ? get_option(PRIME_OPTIONS_KEY) : array();

        //Find all Category, Categories, Page, Pages, Post, Posts types in the schema
        $this->prepExportOptions($this->option_array, $settings);

        $retString = base64_encode(serialize($settings));

        return $retString;
    }

    private function prepExportOptions($options_schema_array, array &$settings)
    {
        $prime_elements = $this->schemaFactory->get_schema_array();
        foreach ($prime_elements as $element) {
            $item_type = $element['item_type'];
            $item_id = $element['item_id'];

            //if there's a value set
            if (isset($settings[$element['item_id']])) {
                switch ($item_type) {
                    case 'slider':
                        $this->prepExportSliderOptions($element, $settings[$item_id]);
                        break;
                }
            }
        }
    }

    private function prepImportOptions($options_schema_array, array &$settings)
    {
        $prime_elements = $this->schemaFactory->get_schema_array();
        foreach ($prime_elements as $element) {
            $item_type = $element['item_type'];
            $item_id = $element['item_id'];

            //if there's a value set
            if (isset($settings[$element['item_id']])) {
                switch ($item_type) {
                    case 'slider':
                        $this->prepImportSliderOptions($element, $settings[$item_id]);
                        break;
                }
            }
        }
    }

    private function prepImportSliderOptions($slider_schema, array &$slider_settings)
    {
        foreach ($slider_settings as &$slide) {
            foreach ($slider_schema['item_options'] as $subelement_schema) {
                $item_type = $subelement_schema['item_type'];
                $item_local_id = $subelement_schema['item_local_id'];

                switch ($item_type) {
                    case 'category':
                        $slide[$item_local_id] = $this->getReferenceValues($slide[$item_local_id],
                            'category',
                            $subelement_schema['item_options']);
                        break;
                    case 'categories':
                        $names = array();
                        foreach ($slide[$item_local_id] as $entry) {
                            $names[] = $this->getReferenceValues($entry,
                                'category',
                                $subelement_schema['item_options']);
                        }
                        $slide[$item_local_id] = $names;
                        break;
                    case 'page':
                    case 'post':
                        $slide[$item_local_id] = $this->getReferenceValues($slide[$item_local_id], 'page');
                        break;
                    case 'pages';
                    case 'posts':
                        $names = array();
                        foreach ($slide[$item_local_id] as $entry) {
                            $names[] = $this->getReferenceValues($entry, 'page');
                        }
                        $slide[$item_local_id] = $names;
                        break;
                }
            }
        }
    }

    private function prepExportSliderOptions($slider_schema, array &$slider_settings)
    {

        foreach ($slider_settings as &$slide) {
            foreach ($slider_schema['item_options'] as $subelement_schema) {
                $item_type = $subelement_schema['item_type'];
                $item_local_id = $subelement_schema['item_local_id'];

                switch ($item_type) {
                    case 'category':
                        $slide[$item_local_id] = $this->prime_get_post_page_cat_name_by_id($slide[$item_local_id],
                            'category',
                            $subelement_schema['item_options']);
                        break;
                    case 'categories':
                        $names = array();
                        foreach ($slide[$item_local_id] as $entry) {
                            $names[] = $this->prime_get_post_page_cat_name_by_id($entry,
                                'category',
                                $subelement_schema['item_options']);
                        }
                        $slide[$item_local_id] = $names;
                        break;
                    case 'page':
                    case 'post':
                        $slide[$item_local_id] = $this->prime_get_post_page_cat_name_by_id($slide[$item_local_id], 'page');
                        break;
                    case 'pages';
                    case 'posts':
                        $names = array();
                        foreach ($slide[$item_local_id] as $entry) {
                            $names[] = $this->prime_get_post_page_cat_name_by_id($entry, 'page');
                        }
                        $slide[$item_local_id] = $names;
                        break;
                }
            }
        }
    }

    function getReferenceValues($name, $type, $taxonomy = false)
    {
        switch ($type)
        {
            case 'page':
            case 'post':
                $the_post = get_page_by_title($name, 'OBJECT', $type);
                if (isset($the_post->ID)) return $the_post->ID;
                break;

            case 'category':
                if (!$taxonomy) $taxonomy = 'category';
                $the_category = get_term_by('name', $name, $taxonomy);

                if ($the_category) return $the_category->term_id;
                break;
        }
    }

    function prime_get_post_page_cat_name_by_id($id, $type, $taxonomy = false)
    {
        switch ($type)
        {
            case 'page':
            case 'post':
                $the_post = get_post($id);
                if (isset($the_post->post_title)) return $the_post->post_title;
                break;
            case 'category':
                if (!$taxonomy) $taxonomy = 'category';
                if (!empty($name)) {
                    $cat = get_term($id, $taxonomy);

                    if ($cat) return $cat->name;
                }
                break;
        }
    }

    function decodeSettings($string)
    {
        return unserialize(base64_decode($string));
    }

    /**
     * Save Theme Option via AJAX
     *
     * @uses check_ajax_referer()
     * @uses update_option()
     * @uses option_tree_set_post_lock()
     * @uses get_option_page_ID()
     *
     * @access public
     * @since 1.0.0
     *
     * @return void
     */
    function prime_options_array_save()
    {
        // Check AJAX Referer
        check_ajax_referer('_theme_options', '_ajax_nonce');

        //        _log($_REQUEST);
        // set option values
        foreach ($this->option_array as $value)
        {
            $key = trim($value->item_id);
            if (isset($_REQUEST[$key])) {
                $val = $_REQUEST[$key];
                $new_settings[$key] = $val;
            }
        }

        // Update Theme Options
        update_option(PRIME_OPTIONS_KEY, $new_settings);

        // lock post editing
        $this->option_tree_set_post_lock($this->get_option_page_ID('media'));

        // hook before AJAX is returned
        do_action('prime_options_array_save');

        die();
    }

    /**
     * Import Option Data via AJAX
     *
     * @uses check_ajax_referer()
     * @uses update()
     *
     * @access public
     * @since 1.0.0
     *
     * @return void
     */
    function prime_options_import_data()
    {
        global $wpdb;

        // check AJAX referer
        check_ajax_referer('_import_data', '_ajax_nonce');

        // Get Data
        $string = $_REQUEST['import_options_data'];

        // Unserialize The Array
        $new_options = $this->decodeSettings($string);

        // check if array()
        if (is_array($new_options)) {
            $this->import_new_options($new_options);

            // redirect
            die();
        }
        // failed
        die('-1');
    }

    /**
     * Reset Theme Option via AJAX
     *
     * @uses check_ajax_referer()
     * @uses update_option()
     *
     * @access public
     * @since 1.0.0
     *
     * @return void
     */
    function prime_options_array_reset()
    {
        global $wpdb;

        // Check AJAX Referer
        check_ajax_referer('_theme_options', '_ajax_nonce');

        if ($this->restore_default_option_data()) {
            // redirect
            die();
        }
        else {
            // failed
            die('-1');
        }
    }

    function option_tree_activate_theme()
    {
        if (!get_option(PRIME_OPTIONS_KEY)) {
            $this->restore_default_option_data();
        }
    }

    private function restore_default_option_data()
    {
        // Get Data
        $string = $this->default_options;

        // Unserialize The Array
        $new_options = $this->decodeSettings($string);

        // check if array()
        if (is_array($new_options)) {
            $this->import_new_options($new_options);

            // redirect
            return true;
        }
        // failed
        return false;
    }

    private function import_new_options($new_options)
    {
        $this->prepImportOptions($this->option_array, $new_options);


        delete_option(PRIME_OPTIONS_KEY);

        // create new options
        add_option(PRIME_OPTIONS_KEY, $new_options);

        // hook after import, before AJAX is returned
        do_action('prime_options_import_data');
    }

    function option_tree_new_slide($slider_id, $count)
    {
        $option = $this->find_option_element($slider_id);

        $subelements = $option->item_options;
        $image = array();
        foreach ($subelements as $se) {
            $se_id = $se->item_local_id;
            if ($se_id == 'order')
                $image[$se_id] = $count + 1;
            else
                $image[$se_id] = isset($se->item_default) ? $se->item_default : '';
        }

        prime_options_option_tree_slider_view($slider_id, $image, $this->get_option_page_ID('media'), $count, $subelements);
    }

    function prime_options_add_slider()
    {
        $count = $_GET['count'] + 1;
        $id = $_GET['slide_id'];
        $this->option_tree_new_slide($id, $count);
        die();
    }

    function find_option_element($element_id)
    {
        $prime_elements = $this->option_array;
        foreach ($prime_elements as $element) {
            if ($element->item_id == $element_id) return $element;
        }
    }

    /**
     * Load Scripts & Styles
     *
     * @uses wp_enqueue_style()
     * @uses get_user_option()
     * @uses add_thickbox()
     * @uses wp_enqueue_script()
     * @uses wp_deregister_style()
     *
     * @access public
     * @since 1.0.0
     *
     * @return void
     */
    function option_tree_load()
    {
        // enqueue styles
        wp_enqueue_style('option-tree-style', PO_PLUGIN_URL . '/assets/css/style.css', false, $this->version, 'screen');
        PRIME_THEME_ROOT_URI;

        // classic admin theme styles
        if (get_user_option('admin_color') == 'classic')
            wp_enqueue_style('option-tree-style-classic', PO_PLUGIN_URL . '/assets/css/style-classic.css', array('option-tree-style'), $this->version, 'screen');

        // enqueue scripts
        add_thickbox();
        wp_enqueue_script('underscore');
        wp_enqueue_script('jquery-prime-plugin-base', PRIME_THEME_ROOT_URI . '/js/prime-plugin-base.js',
            array('jquery'), $this->version);

        wp_enqueue_script('jquery-table-dnd', PO_PLUGIN_URL . '/assets/js/jquery.table.dnd.js', array('jquery'), $this->version);
        wp_enqueue_script('jquery-color-picker', PO_PLUGIN_URL . '/assets/js/jquery.color.picker.js', array('jquery'), $this->version);
        wp_enqueue_script('jquery-prime-options', PO_PLUGIN_URL . '/assets/js/jquery.option.tree.js', array('jquery', 'media-upload', 'thickbox', 'jquery-ui-core', 'jquery-ui-tabs', 'jquery-table-dnd', 'jquery-color-picker', 'jquery-ui-sortable'), $this->version);

        // remove GD star rating conflicts
        wp_deregister_style('gdsr-jquery-ui-core');
        wp_deregister_style('gdsr-jquery-ui-theme');

        // remove Cispm Mail Contact jQuery UI
        wp_deregister_script('jquery-ui-1.7.2.custom.min');
    }

    /**
     * Returns the ID of a cutom post tpye
     *
     * @uses get_results()
     *
     * @access public
     * @since 1.0.0
     *
     * @param string $page_title
     *
     * @return int
     */
    function get_option_page_ID($page_title = '')
    {
        global $wpdb;

        return $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE `post_name` = '{$page_title}' AND `post_type` = 'option-tree' AND `post_status` = 'private'");
    }


    /**
     * Outputs the notice message to say that someone else is editing this post at the moment.
     *
     * @uses get_userdata()
     * @uses get_post_meta()
     * @uses esc_html()
     *
     * @access public
     * @since 1.0.0
     *
     * @param int $post_id
     *
     * @return string
     */
    function option_tree_notice_post_locked($post_id)
    {
        if (!$post_id)
            return false;

        global $FRONTEND_STRINGS;
        $last_user = get_userdata(get_post_meta($post_id, '_edit_last', true));
        $last_user_name = $last_user ? $last_user->display_name : $FRONTEND_STRINGS['ot_somebody'];
        $the_page = ($_GET['page'] == 'option_tree') ? $FRONTEND_STRINGS['ot_theme_options']
            : $FRONTEND_STRINGS['ot_settings'];

        $message = sprintf($FRONTEND_STRINGS['ot_current_editing_warning'], esc_html($last_user_name), $the_page);
        return '<div class="message warning"><span>&nbsp;</span>' . $message . '</div>';
    }

    /**
     * Check to see if the post is currently being edited by another user.
     *
     * @uses get_post_meta()
     * @uses apply_filters()
     * @uses get_current_user_id()
     *
     * @access public
     * @since 1.0.0
     *
     * @param int $post_id
     *
     * @return bool
     */
    function option_tree_check_post_lock($post_id)
    {
        if (!$post_id)
            return false;

        $lock = get_post_meta($post_id, '_edit_lock', true);
        $last = get_post_meta($post_id, '_edit_last', true);

        $time_window = apply_filters('wp_check_post_lock_window', 30);

        if ($lock && $lock > time() - $time_window && $last != get_current_user_id())
            return $last;

        return false;
    }

    /**
     * Mark the post as currently being edited by the current user
     *
     * @uses update_post_meta()
     * @uses get_current_user_id()
     *
     * @access public
     * @since 1.0.0
     *
     * @param int $post_id
     *
     * @return bool
     */
    function option_tree_set_post_lock($post_id)
    {
        if (!$post_id)
            return false;

        if (0 == get_current_user_id())
            return false;

        $now = time();

        update_post_meta($post_id, '_edit_lock', $now);
        update_post_meta($post_id, '_edit_last', get_current_user_id());
    }

    /**
     * Register custom post type & create two posts
     *
     * @uses get_results()
     *
     * @access public
     * @since 1.0.0
     *
     * @return void
     */
    function create_option_post()
    {
        global $current_user;
        global $FRONTEND_STRINGS;
        // profile show docs & settings checkbox
        $this->show_docs = false;

        register_post_type('option-tree', array(
            'labels' => array(
                'name' => $FRONTEND_STRINGS['ot_options'],
            ),
            'public' => true,
            'show_ui' => false,
            'capability_type' => 'post',
            'exclude_from_search' => true,
            'hierarchical' => false,
            'rewrite' => false,
            'supports' => array('title', 'editor'),
            'can_export' => true,
            'show_in_nav_menus' => false,
        ));

        // create a private page to attach media to
        if (isset($_GET['page']) && $_GET['page'] == 'option_tree') {
            // look for custom page
            $page_id = $this->get_option_page_ID('media');

            // no page create it
            if (!$page_id) {
                // create post object
                $_p = array();
                $_p['post_title'] = 'Media';
                $_p['post_status'] = 'private';
                $_p['post_type'] = 'option-tree';
                $_p['comment_status'] = 'closed';
                $_p['ping_status'] = 'closed';

                // insert the post into the database
                $page_id = wp_insert_post($_p);
            }
        }

        // create a private page for settings page
        if (isset($_GET['page']) && $_GET['page'] == 'option_tree_settings') {
            // look for custom page
            $page_id = $this->get_option_page_ID('options');

            // no page create it
            if (!$page_id) {
                // create post object
                $_p = array();
                $_p['post_title'] = 'Options';
                $_p['post_status'] = 'private';
                $_p['post_type'] = 'option-tree';
                $_p['comment_status'] = 'closed';
                $_p['ping_status'] = 'closed';

                // insert the post into the database
                $page_id = wp_insert_post($_p);
            }
        }
    }

}